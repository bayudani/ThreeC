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
        Schema::create('ormawas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Contoh: HIMATIF
            $table->string('kategori'); // BEM, DPM, HIMA, UKM
            $table->string('fakultas')->nullable(); // Contoh: FTI
            $table->string('periode')->nullable(); // Contoh: 2023-2024
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ormawas');
    }
};
