<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('absensis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
        $table->date('tanggal');
        $table->time('waktu');
        $table->decimal('latitude', 10, 6);
        $table->decimal('longitude', 10, 6);
        $table->enum('status', ['masuk', 'izin', 'sakit', 'alpha', 'terlambat']);
        $table->text('keterangan')->nullable();
        $table->boolean('scan_valid')->default(true);
        $table->string('qr_token')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
