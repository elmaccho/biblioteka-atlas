<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rezerwacja extends Model
{
    use HasFactory;

    protected $table = 'rezerwacje';

        protected $fillable = [
        'user_id',
        'ksiazka_id',
        'reserved_at',
        'cancelled_at',
        'zrealizowano',
    ];

        public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ksiazka(): BelongsTo
    {
        return $this->belongsTo(Ksiazka::class);
    }
}
