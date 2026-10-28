<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak_admins', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50); // "Email", "WhatsApp", "Instagram", dll
            $table->string('value'); // nilai kontak
            $table->string('icon', 50)->nullable(); // icon class/slug
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed data awal
        DB::table('kontak_admins')->insert([
            ['label' => 'Email', 'value' => 'kemendagribemunsera26@gmail.com', 'icon' => 'email', 'urutan' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['label' => 'WhatsApp', 'value' => '08123456789', 'icon' => 'whatsapp', 'urutan' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_admins');
    }
};
