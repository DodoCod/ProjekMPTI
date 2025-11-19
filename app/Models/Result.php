<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'score_depression',
        'score_anxiety',
        'score_stress',
        'category_depression', // Interpretasi teks: Normal, Berat, dll. (Opsional)
        'category_anxiety',
        'category_stress',
        'admin_feedback', // Kolom dari analisis dashboard
    ];
    
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
