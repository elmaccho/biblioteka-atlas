<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
{
    use HasFactory;

    protected $table = 'kategorie';
    protected $fillable = [
        'nazwa',
    ];

    public function ksiazki()
    {
        return $this->hasMany(Ksiazka::class);
    }
}
