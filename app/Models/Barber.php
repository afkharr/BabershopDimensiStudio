<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // Relasi profil barber dengan data hari libur
    public function daysOff(): HasMany
    {
        return $this->hasMany(BarberDayOff::class);
    }
}
