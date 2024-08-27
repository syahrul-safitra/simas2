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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->string('indek_berkas')->nullable();
            $table->string('kode_klasifikasi_arsip')->nullable();
            $table->date('tanggal_penyelesaian')->nullable();
            $table->text('isi');
            $table->string('kepada')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('pukul')->nullable();
            $table->timestamps(); // default setting

            // foreign key : 
            $table->foreignId('surat_masuk_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
