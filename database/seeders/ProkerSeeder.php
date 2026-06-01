<?php

namespace Database\Seeders;

use App\Models\Ormawa;
use App\Models\Proker;
use Illuminate\Database\Seeder;

class ProkerSeeder extends Seeder
{
    public function run(): void
    {
        $prokers = [
            // BEM U
            ['ormawa' => 'BEM U', 'nama_proker' => 'Pemilihan Raya Mahasiswa (PEMIRA)', 'deskripsi' => 'Pemilihan ketua BEM dan DPM periode baru.', 'target_waktu' => '2025-01-15', 'status' => 'selesai', 'progress' => 100],
            ['ormawa' => 'BEM U', 'nama_proker' => 'Musyawarah Besar (MUBES)', 'deskripsi' => 'Musyawarah besar untuk evaluasi program kerja tahunan.', 'target_waktu' => '2025-03-20', 'status' => 'berjalan', 'progress' => 65],

            // BEM FTI
            ['ormawa' => 'BEM FTI', 'nama_proker' => 'Inovasi Teknologi 2025', 'deskripsi' => 'Lomba karya tulis ilmiah dan inovasi teknologi tingkat mahasiswa.', 'target_waktu' => '2025-05-10', 'status' => 'berjalan', 'progress' => 40],
            ['ormawa' => 'BEM FTI', 'nama_proker' => 'Seminar Digital Marketing', 'deskripsi' => 'Seminar pengembangan skill digital marketing untuk mahasiswa FTI.', 'target_waktu' => '2024-12-01', 'status' => 'selesai', 'progress' => 100],

            // DPM U
            ['ormawa' => 'DPM U', 'nama_proker' => 'Rapat Paripurna DPM', 'deskripsi' => 'Rapat paripurna pengawasan kinerja BEM dan ormawa.', 'target_waktu' => '2025-02-28', 'status' => 'berjalan', 'progress' => 50],
            ['ormawa' => 'DPM U', 'nama_proker' => 'Audit Kinerja Ormawa', 'deskripsi' => 'Audit dan evaluasi kinerja seluruh ormawa periode berjalan.', 'target_waktu' => '2025-06-15', 'status' => 'belum_dimulai', 'progress' => 0],

            // HIMATIF
            ['ormawa' => 'HIMATIF', 'nama_proker' => 'Coding Camp 2025', 'deskripsi' => 'Pelatihan intensif pemrograman untuk anggota HIMATIF.', 'target_waktu' => '2025-04-20', 'status' => 'berjalan', 'progress' => 35],
            ['ormawa' => 'HIMATIF', 'nama_proker' => 'Seminar Nasional AI', 'deskripsi' => 'Seminar nasional tentang kecerdasan buatan dan penerapannya.', 'target_waktu' => '2025-07-10', 'status' => 'belum_dimulai', 'progress' => 0],
            ['ormawa' => 'HIMATIF', 'nama_proker' => 'HIMATIF Cup', 'deskripsi' => 'Turnamen e-sport dan game development antar mahasiswa.', 'target_waktu' => '2024-11-30', 'status' => 'selesai', 'progress' => 100],

            // HIMAKOM
            ['ormawa' => 'HIMAKOM', 'nama_proker' => 'Public Speaking Workshop', 'deskripsi' => 'Workshop public speaking dan komunikasi efektif.', 'target_waktu' => '2025-03-15', 'status' => 'selesai', 'progress' => 100],
            ['ormawa' => 'HIMAKOM', 'nama_proker' => 'Jurnalistik Mahasiswa', 'deskripsi' => 'Pelatihan jurnalistik dan pembuatan konten media.', 'target_waktu' => '2025-05-30', 'status' => 'berjalan', 'progress' => 25],

            // UKM KAMUS
            ['ormawa' => 'UKM KAMUS', 'nama_proker' => 'Kajian Rutin Mingguan', 'deskripsi' => 'Kajian keislaman rutin setiap pekan.', 'target_waktu' => '2025-12-31', 'status' => 'berjalan', 'progress' => 70],
            ['ormawa' => 'UKM KAMUS', 'nama_proker' => 'Buka Bersama Ramadhan', 'deskripsi' => 'Kegiatan buka puasa bersama dan tausiyah.', 'target_waktu' => '2025-03-25', 'status' => 'selesai', 'progress' => 100],
        ];

        foreach ($prokers as $data) {
            $ormawa = Ormawa::where('nama', $data['ormawa'])->first();
            if ($ormawa) {
                Proker::create([
                    'ormawa_id' => $ormawa->id,
                    'nama_proker' => $data['nama_proker'],
                    'deskripsi' => $data['deskripsi'],
                    'target_waktu' => $data['target_waktu'],
                    'status' => $data['status'],
                    'progress' => $data['progress'],
                ]);
            }
        }
    }
}
