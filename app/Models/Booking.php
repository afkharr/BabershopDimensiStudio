<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    // Menentukan nama tabel.
    protected $table = 'bookings';

    // Kolom yang boleh diisi melalui mass assignment.
    protected $fillable = [
        'kode_booking',
        'nama_customer',
        'no_hp',
        'barber_id',
        'tanggal',
        'jam',
        'nomor_antrean',
        'status',
        'catatan',
    ];

    // Mengatur tipe data tanggal.
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Relasi booking dengan barber.
     */
    public function barber(): BelongsTo
    {
        return $this->belongsTo(Barber::class);
    }
}
