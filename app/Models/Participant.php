<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_code',
        'name',
        'email',
        'date_of_birth',
        'age',
        'gender',
        'date_of_test',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_test' => 'datetime',
    ];

    // Auto-generate unique code saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($participant) {
            if (empty($participant->unique_code)) {
                $participant->unique_code = (string) Str::uuid();
            }
        });
    }

    // Relationships
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    // Route model binding by unique_code instead of id
    public function getRouteKeyName()
    {
        return 'unique_code';
    }
}