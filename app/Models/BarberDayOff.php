<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarberDayOff extends Model
{
    // Menentukan nama tabel secara manual.
    protected $table = 'barber_days_off';

    protected $fillable = [
        'barber_id',
        'tanggal',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Relasi ke tabel barbers.
     */
    public function barber(): BelongsTo
    {
        return $this->belongsTo(Barber::class);
    }
}
