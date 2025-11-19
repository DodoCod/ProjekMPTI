<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'question_number',
        'text',
    ];
    
    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Relasi ke Jawaban
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
