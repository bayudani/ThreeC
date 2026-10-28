<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ormawas', function (Blueprint $table) {
            $table->foreignId('fakultas_id')->nullable()->after('kategori')->constrained('fakultas')->nullOnDelete();
        });

        // Migrate existing data: map fakultas string to fakultas_id
        $mapping = [
            'FTI' => 1,
            'FEB-SIP' => 2,
            'FISIPKUM' => 3,
            'FT' => 4,
            'Universitas' => 5,
        ];

        foreach ($mapping as $kode => $id) {
            DB::table('ormawas')->where('fakultas', $kode)->update(['fakultas_id' => $id]);
        }

        // UKM auto ke Universitas
        DB::table('ormawas')->where('kategori', 'UKM')->whereNull('fakultas_id')->update(['fakultas_id' => 5]);
    }

    public function down(): void
    {
        Schema::table('ormawas', function (Blueprint $table) {
            $table->dropForeign(['fakultas_id']);
            $table->dropColumn('fakultas_id');
        });
    }
};
