<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Response;
use App\Models\Result;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session; // Import Session Facade
use Illuminate\Support\Facades\DB;

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
            'birth_date' => 'required|date|before_or_equal:today', // Field name di view: birth_date
            'gender' => 'required|in:Laki-laki,Perempuan,Lainnya',
        ]);

        $dob = Carbon::parse($validatedData['birth_date']);
        $age = $dob->age;

        $participant = Participant::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ?? null,
            'date_of_birth' => $dob, // Simpan ke kolom database: date_of_birth
            'age' => $age,
            'gender' => $validatedData['gender'],
            'date_of_test' => now(), 
        ]);

        // Inisialisasi Session untuk sesi tes
        Session::put('current_participant_id', $participant->id);
        Session::put('dass_responses', []);

        // Redirect ke RUTE test_form (step 1)
        return redirect()->route('dass.test.start', ['step' => 1]); 
    }
    
    // FUNGSI 3: MENAMPILKAN PERTANYAAN SATU PER SATU (showTest)
    public function showTest(Request $request, $step = 1)
    {
        $participantId = Session::get('current_participant_id');
        
        if (!$participantId) {
            return redirect()->route('landing')->with('error', 'Silakan isi data diri Anda terlebih dahulu.');
        }
        
        // 1. Ambil semua 42 pertanyaan. Koreksi kolom pengurutan menjadi 'question_number'
        $allQuestions = Question::with('category')->orderBy('question_number', 'asc')->get();
        $totalQuestions = $allQuestions->count();
        
        // Validasi langkah
        $step = (int) $step;
        if ($step < 1 || $step > $totalQuestions) {
            // Arahkan kembali ke langkah pertama jika step tidak valid
            return redirect()->route('dass.test.start', ['step' => 1]);
        }

        // Ambil pertanyaan saat ini
        $currentQuestion = $allQuestions->skip($step - 1)->first();
        $responses = Session::get('dass_responses', []);
        $savedAnswer = $responses[$currentQuestion->id] ?? null;

        return view('dass_test.test_form', compact( // Menggunakan nama view: test_form
            'currentQuestion', 
            'step', 
            'totalQuestions', 
            'participantId',
            'savedAnswer'
        ));
    }
    
    // FUNGSI 4: MENYIMPAN JAWABAN LANGKAH SAAT INI (submitStep)
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

        if ($request->step >= $totalQuestions) {
            // Jika ini adalah langkah terakhir, redirect ke fungsi finalisasi
            return redirect()->route('dass.test.finish');
        }

        // Lanjut ke pertanyaan berikutnya
        return redirect()->route('dass.test.start', ['step' => $nextStep]);
    }

    // FUNGSI 5: FINALISASI TES & KALKULASI HASIL (finishTest)
    public function finishTest(Request $request)
    {
        $participantId = Session::get('current_participant_id');
        $responses = Session::get('dass_responses', []);
        $totalQuestions = Question::count();

        if (count($responses) < $totalQuestions) {
            return redirect()->route('dass.test.start', ['step' => count($responses) + 1])
                             ->with('error', 'Mohon lengkapi semua 42 pertanyaan sebelum menyelesaikan tes.');
        }

        if (!$participantId) {
            return redirect()->route('landing')->with('error', 'Sesi tes tidak valid.');
        }

        $questions = Question::all()->keyBy('id');
        $categories = Category::pluck('code', 'id');
        $rawScores = $categories->flip()->map(fn() => 0)->toArray(); 

        DB::beginTransaction();
        try {
            foreach ($responses as $qId => $score) {
                // Simpan ke tabel Responses
                Response::create([
                    'participant_id' => $participantId,
                    'question_id' => $qId,
                    'score' => $score,
                ]);

                // Akumulasi Skor
                $categoryCode = $categories[$questions[$qId]->category_id];
                $rawScores[$categoryCode] += $score;
            }

            // Kalkulasi Skor Akhir
            $finalScores = [
                'Depression' => $rawScores['D'] * 2,
                'Anxiety' => $rawScores['A'] * 2,
                'Stress' => $rawScores['S'] * 2,
            ];
            
            list($categories) = $this->interpretScores($finalScores);
            
            // Simpan Hasil Akhir
            Result::create([
                'participant_id' => $participantId,
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
            // Hapus data peserta jika transaksi gagal total (opsional)
            Participant::destroy($participantId);
            return redirect()->route('landing')->with('error', 'Terjadi kesalahan sistem saat menyimpan hasil.');
        }

        // Hapus session dan redirect ke hasil
        Session::forget(['current_participant_id', 'dass_responses']);
        return redirect()->route('dass.results', ['participantId' => $participantId]);
    }
    
    // FUNGSI 6: INTERPRETASI SKOR (Dipertahankan untuk perhitungan kategori teks)
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
    
    //---------------------------------------------------------
    // FUNGSI 7: MENAMPILKAN HASIL (showResults)
    //---------------------------------------------------------
    public function showResults($participantId)
    {
        $participant = Participant::with('result')->findOrFail($participantId);
        
        if (!$participant->result) {
            return redirect()->route('landing')->with('error', 'Hasil tes tidak ditemukan.');
        }

        $responses = $participant->responses()->with('question.category')->orderBy('question_id')->get();
        
        return view('dass_test.results', compact('participant', 'responses'));
    }
}