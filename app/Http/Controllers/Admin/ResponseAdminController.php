<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseAdminController extends Controller
{
    // Menampilkan daftar seua hasil tes 
    public function index()
    {
        // Mengambil data peserta dengan hasil skor, diurutkan berdasarkan tanggal tes terbaru
        $participants = Participant::with('result')
                                    ->orderBy('date_of_test', 'desc')
                                    ->paginate(10); // Pagination 10 entries

        return view('admin.responses.index', compact('participants'));
    }

    // Menampilkan detail hasil tes dari satu peserta
    public function show(Participant $participant)
    {
        // Memastikan relasi hasil dan jawaban dimuat
        $participant->load(['result', 'responses.question.category']);
        
        // Mengambil detail jawaban yang sudah diurutkan berdasarkan nomor pertanyaan
        $responsesDetail = $participant->responses->sortBy('question.question_number');
        
        return view('admin.responses.show', compact('participant', 'responsesDetail'));
    }

    // Menghapus data peserta dan semua hasil/respon terkait
    public function destroy(Participant $participant)
    {
        // Data responses dan results terkait akan terhapus otomatis kalau data peserta dihapus karna menggunakan onDelete('cascade')
        $participant->delete(); 

        return redirect()->route('admin.responses.index')
                         ->with('success', 'Data hasil tes peserta ' . $participant->name . ' berhasil dihapus.');
    }
}