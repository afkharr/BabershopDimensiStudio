
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('kode_booking')->unique();

            // Identitas pelanggan tanpa akun.
            $table->string('nama_customer');
            $table->string('no_hp', 20);

            // Relasi dengan barber.
            $table->foreignId('barber_id')
                ->constrained('barbers')
                ->cascadeOnDelete();

            // Informasi jadwal booking.
            $table->date('tanggal');
            $table->time('jam');

            // Nomor antrean pelanggan.
            $table->unsignedInteger('nomor_antrean');

            // Status booking.
            $table->enum('status', [
                'menunggu',
                'sedang_dilayani',
                'selesai',
                'dibatalkan',
            ])->default('menunggu');

            // Catatan tambahan dari pelanggan.
            $table->text('catatan')->nullable();

            $table->timestamps();

            // Mencegah nomor antrean ganda
            // untuk seluruh studio pada tanggal yang sama.
            $table->unique([
                'tanggal',
                'nomor_antrean',
            ]);

            // Mencegah barber menerima dua booking
            // pada tanggal dan jam yang sama.
            $table->unique([
                'barber_id',
                'tanggal',
                'jam',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
