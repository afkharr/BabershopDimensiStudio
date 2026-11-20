<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barber extends Model
{
    protected $fillable = [
        'user_id',
        'photo',
        'description',
        'status',
    ];

    // Relasi profil barber dengan akun internal
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
