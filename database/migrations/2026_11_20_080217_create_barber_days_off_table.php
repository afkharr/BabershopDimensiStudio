
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barber_days_off', function (Blueprint $table) {
            $table->id();

            // Relasi dengan tabel barbers.
            $table->foreignId('barber_id')
                ->constrained('barbers')
                ->cascadeOnDelete();

            // Tanggal barber mengambil libur.
            $table->date('tanggal');

            // Keterangan tambahan (opsional).
            $table->string('keterangan')->nullable();

            $table->timestamps();

            // Mencegah barber memiliki dua catatan
            // libur pada tanggal yang sama.
            $table->unique(['barber_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barber_days_off');
    }
};
