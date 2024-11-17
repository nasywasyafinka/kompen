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
        Schema::create('m_tendik', function (Blueprint $table) {
            $table->id('tendik_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nip')->unique();
            $table->string('tendik_nama');
            $table->string('tendik_no_telp');
            $table->timestamps();

            $table->foreign(columns: 'user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_tendik', function (Blueprint $table) {
            Schema::dropIfExists('m_tendik');
        });
    }
};
