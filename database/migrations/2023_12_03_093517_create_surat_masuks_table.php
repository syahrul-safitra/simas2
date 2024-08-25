<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->string('asal_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_diterima');
            $table->enum('sifat', ['biasa', 'penting', 'rahasia']);
            $table->string('isi_ringkas');
            $table->enum('status', ['diketahui', 'dihadiri', 'ditindak lanjuti(proses)']);
            $table->string('file')->nullable();
            $table->enum('keadaan', ['proses', 'selesai'])->default('proses');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
