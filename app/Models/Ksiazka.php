<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ksiazka extends Model
{
    use HasFactory;

    protected $table = 'ksiazki';

    protected $fillable = [
        'tytul',
        'opis',
        'amount',
        'kategoria_id',
        'autor_id',
        'img_src',
    ];

    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class, "kategoria_id");
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, "autor_id");
    }
    public function rezerwacje()
    {
        return $this->hasMany(Rezerwacja::class);
    }
}
