<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age',
        'gender',
        'date_of_birth', // Kolom baru
        'date_of_test',
    ];

    // Kolom yang akan otomatis dikonversi menjadi objek Carbon/Date
    protected $casts = [
        'date_of_birth' => 'date', 
        'date_of_test' => 'datetime',
    ];
    
    // Relasi ke Hasil
    public function result()
    {
        return $this->hasOne(Result::class);
    }
    
    // Relasi ke Jawaban
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
