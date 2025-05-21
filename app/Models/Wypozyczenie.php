<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wypozyczenie extends Model
{
    use HasFactory;

    protected $table = 'wypozyczenia';

    protected $fillable = [
        'user_id',
        'ksiazka_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'przedluzono'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ksiazka()
    {
        return $this->belongsTo(Ksiazka::class);
    }
}
