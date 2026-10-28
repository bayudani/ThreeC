<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->enum('tahapan_saat_ini', ['perencanaan', 'persiapan', 'pelaksanaan', 'evaluasi', 'selesai'])
                ->default('perencanaan')
                ->after('status');
        });

        // Migrate existing data: map status to tahapan
        DB::statement("
            UPDATE prokers SET tahapan_saat_ini = CASE
                WHEN status = 'selesai' THEN 'selesai'
                WHEN status = 'berjalan' AND progress >= 80 THEN 'evaluasi'
                WHEN status = 'berjalan' AND progress >= 60 THEN 'pelaksanaan'
                WHEN status = 'berjalan' AND progress >= 40 THEN 'persiapan'
                ELSE 'perencanaan'
            END
        ");
    }

    public function down(): void
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->dropColumn('tahapan_saat_ini');
        });
    }
};
