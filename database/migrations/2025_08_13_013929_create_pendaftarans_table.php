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
    Schema::create('pendaftarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pasien_id')->constrained()->onDelete('cascade');
        $table->string('poli');
        $table->string('nomor_antrian');
        $table->date('tanggal_kunjungan');
        $table->enum('status', ['Terdaftar', 'Selesai'])->default('Terdaftar');
        $table->timestamps();
    
    });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
