<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Result;
use App\Models\Category;
use App\Models\Question;
use App\Models\Response;
use App\Models\Participant;
use App\Mail\TestResultMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DassTestController extends Controller
{
    // FUNGSI 1: MENAMPILKAN FORMULIR DATA DIRI AWAL
    public function showDataForm()
    {
        return view('dass_test.data_form');
    }

    // FUNGSI 2: MENYIMPAN DATA DIRI DAN MEMULAI SESI TES
    public function storeDataAndStartTest(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'birth_date' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:Laki-laki,Perempuan,Lainnya',
        ]);

        $dob = Carbon::parse($validatedData['birth_date']);
        $age = $dob->age;

        $participant = Participant::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ?? null,
            'date_of_birth' => $dob,
            'age' => $age,
            'gender' => $validatedData['gender'],
            'date_of_test' => now(), 
        ]);

        // ✅ PERBAIKAN: Gunakan unique_code di session, bukan id
        Session::put('current_participant_unique_code', $participant->unique_code);
        Session::put('dass_responses', []);

        return redirect()->route('dass.test.start', ['step' => 1]); 
    }
    
    // FUNGSI 3: MENAMPILKAN PERTANYAAN SATU PER SATU
    public function showTest(Request $request, $step = 1)
    {
        Session::forget('url.intended'); // Tambahkan ini
        
        $participantUniqueCode = Session::get('current_participant_unique_code');
        
        if (!$participantUniqueCode) {
            return redirect()->route('dass.data.form')
                            ->with('error', 'Silakan isi data diri Anda terlebih dahulu.');
        }
        
        $allQuestions = Question::with('category')->orderBy('question_number', 'asc')->get();
        $totalQuestions = $allQuestions->count();
        
        $step = (int) $step;
        if ($step < 1 || $step > $totalQuestions) {
            return redirect()->route('dass.test.start', ['step' => 1]);
        }

        $currentQuestion = $allQuestions->skip($step - 1)->first();
        
        if (!$currentQuestion) {
            return redirect()->route('dass.test.start', ['step' => 1]);
        }
        
        $responses = Session::get('dass_responses', []);
        $savedAnswer = $responses[$currentQuestion->id] ?? null;

        return view('dass_test.test_form', compact( 
            'currentQuestion', 
            'step', 
            'totalQuestions', 
            'participantUniqueCode',
            'savedAnswer'
        ));
    }
    
    // FUNGSI 4: MENYIMPAN JAWABAN LANGKAH SAAT INI
    public function submitStep(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'step' => 'required|integer|min:1',
            'score' => 'required|integer|min:0|max:3',
        ]);
        
        $nextStep = (int) $request->step + 1;
        $questionId = $request->question_id;
        $score = $request->score;
        
        $responses = Session::get('dass_responses', []);
        $responses[$questionId] = $score;
        Session::put('dass_responses', $responses);

        $totalQuestions = Question::count();

        if ($request->time_expired == '1') {
            return $this->finishTest($request);
        }

        if ($request->step >= $totalQuestions) {
            return redirect()->route('dass.test.finish');
        }

        return redirect()->route('dass.test.start', ['step' => $nextStep]);
    }

    // FUNGSI 5: FINALISASI TES & KALKULASI HASIL
    public function finishTest(Request $request)
    {
        // Ambil unique_code dari session
        $participantUniqueCode = Session::get('current_participant_unique_code');
        $responses = Session::get('dass_responses', []);
        $totalQuestions = Question::count();
        $timeExpired = $request->input('time_expired', '0') == '1';

        if (!$timeExpired && count($responses) < $totalQuestions) {
            return redirect()->route('dass.test.start', ['step' => count($responses) + 1])
                             ->with('error', 'Mohon lengkapi semua 42 pertanyaan sebelum menyelesaikan tes.');
        }

        if (!$participantUniqueCode) {
            return redirect()->route('landing')->with('error', 'Sesi tes tidak valid.');
        }

        // Query berdasarkan unique_code
        $participant = Participant::where('unique_code', $participantUniqueCode)->firstOrFail();

        $questions = Question::all()->keyBy('id');
        $categories = Category::pluck('code', 'id');
        $rawScores = $categories->flip()->map(fn() => 0)->toArray(); 

        DB::beginTransaction();
        try {
            foreach ($responses as $qId => $score) {
                Response::create([
                    'participant_id' => $participant->id,
                    'question_id' => $qId,
                    'score' => $score,
                ]);

                $categoryCode = $categories[$questions[$qId]->category_id];
                $rawScores[$categoryCode] += $score;
            }

            $finalScores = [
                'Depression' => $rawScores['D'],
                'Anxiety' => $rawScores['A'],
                'Stress' => $rawScores['S'],
            ];
            
            list($categories) = $this->interpretScores($finalScores);
            
            Result::create([
                'participant_id' => $participant->id,
                'score_depression' => $finalScores['Depression'],
                'score_anxiety' => $finalScores['Anxiety'],
                'score_stress' => $finalScores['Stress'],
                'category_depression' => $categories['Depression'],
                'category_anxiety' => $categories['Anxiety'],
                'category_stress' => $categories['Stress'],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('landing')->with('error', 'Terjadi kesalahan sistem saat menyimpan hasil.');
        }

        // ✅ PERBAIKAN: Redirect dengan unique_code
        Session::forget(['current_participant_unique_code', 'dass_responses']);
        return redirect()->route('dass.results', ['participant' => $participant->unique_code]);
    }
    
    // FUNGSI 6: INTERPRETASI SKOR
    private function interpretScores(array $scores)
    {
        $categories = [];
        $thresholds = [
            'Depression' => ['Normal' => 9, 'Ringan' => 13, 'Sedang' => 20, 'Berat' => 27],
            'Anxiety' => ['Normal' => 7, 'Ringan' => 9, 'Sedang' => 14, 'Berat' => 19],
            'Stress' => ['Normal' => 14, 'Ringan' => 18, 'Sedang' => 25, 'Berat' => 33],
        ];

        foreach ($scores as $dimensi => $score) {
            $threshold = $thresholds[$dimensi];
            
            if ($score <= $threshold['Normal']) {
                $categories[$dimensi] = 'Normal';
            } elseif ($score <= $threshold['Ringan']) {
                $categories[$dimensi] = 'Ringan';
            } elseif ($score <= $threshold['Sedang']) {
                $categories[$dimensi] = 'Sedang';
            } elseif ($score <= $threshold['Berat']) {
                $categories[$dimensi] = 'Berat';
            } else {
                $categories[$dimensi] = 'Sangat Berat';
            }
        }
        
        return [$categories];
    }
    
    // FUNGSI 7: MENAMPILKAN HASIL
    public function showResults(Participant $participant)
    {
        if (!$participant->result) {
            return redirect()->route('landing')->with('error', 'Hasil tes tidak ditemukan.');
        }

        $responses = $participant->responses()->with('question.category')->orderBy('question_id')->get();
        
        return view('dass_test.results', compact('participant', 'responses'));
    }

    // FUNGSI 8: MENGIRIM HASIL KE EMAIL
    public function sendResultEmail(Request $request, Participant $participant)
    {
        if (!$participant->email) {
            return back()->with('error', 'Email tidak tersedia. Tidak dapat mengirim hasil.');
        }

        try {
            Mail::to($participant->email)->send(new TestResultMail($participant));
            
            return back()->with('success', 'Hasil tes berhasil dikirim ke email ' . $participant->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }
}