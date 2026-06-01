<?php

namespace Database\Seeders;

use App\Models\Ormawa;
use Illuminate\Database\Seeder;

class OrmawaSeeder extends Seeder
{
    public function run(): void
    {
        $ormawas = [
            ['nama' => 'MPM U', 'kategori' => 'MPM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'DPM U', 'kategori' => 'DPM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'DPM FT', 'kategori' => 'DPM', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'DPM FTI', 'kategori' => 'DPM', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'DPM FEB-SIP', 'kategori' => 'DPM', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'DPM FISIPKUM', 'kategori' => 'DPM', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'BEM U', 'kategori' => 'BEM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'BEM FT', 'kategori' => 'BEM', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'BEM FTI', 'kategori' => 'BEM', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'BEM FEB-SIP', 'kategori' => 'BEM', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'BEM FISIPKUM', 'kategori' => 'BEM', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'HIMATEKA', 'kategori' => 'HIMA', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HMTI', 'kategori' => 'HIMA', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HIMATSU', 'kategori' => 'HIMA', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HIMATIF', 'kategori' => 'HIMA', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'HIMASTER', 'kategori' => 'HIMA', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'HMSI', 'kategori' => 'HIMA', 'fakultas' => 'FTI', 'periode' => '2024-2025'],
            ['nama' => 'HUMAN', 'kategori' => 'HIMA', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'HIMAKSI', 'kategori' => 'HIMA', 'fakultas' => 'FEB-SIP', 'periode' => '2024-2025'],
            ['nama' => 'HIMATIKA', 'kategori' => 'HIMA', 'fakultas' => 'FT', 'periode' => '2024-2025'],
            ['nama' => 'HIMAKOM', 'kategori' => 'HIMA', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'HIMAKUM', 'kategori' => 'HIMA', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'HIMANURA', 'kategori' => 'HIMA', 'fakultas' => 'FISIPKUM', 'periode' => '2024-2025'],
            ['nama' => 'UKM LDK KHARISMA', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM LPM WISMA', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM PO', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM AKUSTIK', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM KAMUS', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
            ['nama' => 'UKM KSR PMI', 'kategori' => 'UKM', 'fakultas' => 'Universitas', 'periode' => '2024-2025'],
        ];

        foreach ($ormawas as $ormawa) {
            Ormawa::create($ormawa);
        }
    }
}
