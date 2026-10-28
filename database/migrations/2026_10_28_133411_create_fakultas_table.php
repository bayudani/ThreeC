<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('kode', 10)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed data awal
        DB::table('fakultas')->insert([
            ['nama' => 'Fakultas Teknik Informatika', 'kode' => 'FTI', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Fakultas Ekonomi Bisnis - Sosial dan Ilmu Politik', 'kode' => 'FEB-SIP', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Fakultas Ilmu Sosial, Ilmu Politik, dan Hukum', 'kode' => 'FISIPKUM', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Fakultas Teknik', 'kode' => 'FT', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Universitas', 'kode' => 'UNSERA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('fakultas');
    }
};
