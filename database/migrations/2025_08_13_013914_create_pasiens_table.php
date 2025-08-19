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
    Schema::create('pasiens', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('no_ktp')->unique();
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->enum('jenis_pembayaran', ['BPJS', 'Umum']);
        $table->string('no_bpjs')->nullable();
        $table->timestamps();
    });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
