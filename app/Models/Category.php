<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code',
    ];
    
    // Relasi ke Pertanyaan (Satu kategori memiliki banyak pertanyaan)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
