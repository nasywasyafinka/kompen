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
        Schema::create('t_kompetensi', function (Blueprint $table) {
            $table->id('kompetensi_id');
            $table->unsignedBigInteger('jenis_id');
            $table->string('kompetensi_kode')->unique();
            $table->string('kompetensi_nama');
            $table->string('kompetensi_deskripsi');
            $table->timestamps();

            $table->foreign('jenis_id')->references('jenis_id')->on('m_jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kompetensi');
    }
};
