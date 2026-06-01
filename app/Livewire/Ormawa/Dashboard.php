<?php

namespace App\Livewire\Ormawa;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Proker;
use App\Models\Pengumuman;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $isModalOpen = false;

    #[Rule('required|min:5', message: 'Nama program kerja minimal 5 karakter.')]
    public $nama_proker;

    #[Rule('nullable|string', message: 'Deskripsi harus berupa teks.')]
    public $deskripsi;

    #[Rule('required|date', message: 'Target waktu wajib diisi dengan format tanggal.')]
    public $target_waktu;

    public function openModal()
    {
        $this->resetValidation();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['nama_proker', 'deskripsi', 'target_waktu']);
    }

    public function simpanProker()
    {
        // 1. Validasi Input
        $this->validate();

        // 2. Simpan ke Database
        Proker::create([
            'ormawa_id' => Auth::user()->ormawa_id,
            'nama_proker' => $this->nama_proker,
            'deskripsi' => $this->deskripsi,
            'target_waktu' => $this->target_waktu,
            'status' => 'belum_dimulai', // Status default
            'progress' => 0, // Progress default
        ]);

        // 3. Tutup modal & beri notifikasi
        $this->closeModal();
        session()->flash('success', 'Program kerja berhasil didaftarkan! Silakan pantau progresnya.');
    }

    public function render()
    {
        $user = Auth::user();
        $ormawaId = $user->ormawa_id;

        // 1. Hitung Metrik Program Kerja khusus Ormawa ini
        $metrics = [
            'total' => Proker::where('ormawa_id', $ormawaId)->count(),
            'selesai' => Proker::where('ormawa_id', $ormawaId)->where('status', 'selesai')->count(),
            'berjalan' => Proker::where('ormawa_id', $ormawaId)->where('status', 'berjalan')->count(),

            // Logika sederhana: Proker sudah selesai tapi dokumentasinya belum ada (laporan tertunda)
            'tertunda' => Proker::where('ormawa_id', $ormawaId)
                ->where('status', 'selesai')
                ->doesntHave('dokumentasis')
                ->count(),
        ];

        // 2. Ambil 3 Proker Terkini
        $prokerTerkini = Proker::where('ormawa_id', $ormawaId)
            ->latest()
            ->take(3)
            ->get();

        // 3. Ambil Pengumuman Kampus yang Aktif
        $pengumumans = Pengumuman::where('is_active', true)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.ormawa.dashboard', [
            'metrics' => $metrics,
            'prokerTerkini' => $prokerTerkini,
            'pengumumans' => $pengumumans,
        ]);
    }
}
