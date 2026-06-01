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
        Schema::create('prokers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ormawa_id')->constrained('ormawas')->cascadeOnDelete();
            $table->string('nama_proker');
            $table->text('deskripsi')->nullable();
            $table->date('target_waktu');
            $table->enum('status', ['belum_dimulai', 'berjalan', 'selesai'])->default('belum_dimulai');
            $table->tinyInteger('progress')->default(0); // 0 sampai 100 persentase
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokers');
    }
};
