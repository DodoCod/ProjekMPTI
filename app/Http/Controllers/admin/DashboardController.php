<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Jumlah Responden dan
        $totalParticipants = Participant::count();
        $totalQuestions = Question::count();
        
        // Perhitungan Rata-rata skor untuk Grafik
        $averageDepression = Result::avg('score_depression') ?? 0;
        $averageAnxiety = Result::avg('score_anxiety') ?? 0;
        $averageStress = Result::avg('score_stress') ?? 0;
        
        // Perhitungan kedua untuk Desimal
        $averageDepression = round($averageDepression, 2);
        $averageAnxiety = round($averageAnxiety, 2);
        $averageStress = round($averageStress, 2);
        
        return view('admin.dashboard', compact(
            'totalParticipants',
            'totalQuestions',
            'averageDepression',
            'averageAnxiety',
            'averageStress'
        ));
    }
}