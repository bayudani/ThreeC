<?php

namespace Database\Seeders;

use App\Models\Ormawa;
use Illuminate\Database\Seeder;

class OrmawaSeeder extends Seeder
{
    public function run(): void
    {
        $ormawas = [
            // LEGISLATIF
            ['nama' => 'MPM U', 'kategori' => 'Legislatif', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'DPM U', 'kategori' => 'Legislatif', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'DPM FTI', 'kategori' => 'Legislatif', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'DPM FT', 'kategori' => 'Legislatif', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'DPM FISIPKUM', 'kategori' => 'Legislatif', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'DPM FEB-SIP', 'kategori' => 'Legislatif', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            // EKSEKUTIF
            ['nama' => 'BEM U', 'kategori' => 'Eksekutif', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'BEM FTI', 'kategori' => 'Eksekutif', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'BEM FT', 'kategori' => 'Eksekutif', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'BEM FISIPKUM', 'kategori' => 'Eksekutif', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'BEM FEB-SIP', 'kategori' => 'Eksekutif', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'HIMATIF', 'kategori' => 'Eksekutif', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'HIMASTER', 'kategori' => 'Eksekutif', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'HMSI', 'kategori' => 'Eksekutif', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'HIMATEKA', 'kategori' => 'Eksekutif', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HMTI', 'kategori' => 'Eksekutif', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HIMATSU', 'kategori' => 'Eksekutif', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HIMAKOM', 'kategori' => 'Eksekutif', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'HIMAKUM', 'kategori' => 'Eksekutif', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'HIMANURA', 'kategori' => 'Eksekutif', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'HUMAN', 'kategori' => 'Eksekutif', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'HIMAKSI', 'kategori' => 'Eksekutif', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'HIMATIKA', 'kategori' => 'Eksekutif', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            // UKM
            ['nama' => 'UKM LDK KHARISMA', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM LPM WISMA', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM PO', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM AKUSTIK', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM KAMUS', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM KSR PMI', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM LENTERA', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
        ];

        foreach ($ormawas as $ormawa) {
            Ormawa::create($ormawa);
        }
    }
}
