<?php

namespace App\Livewire\Admin;

use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProgramKerja extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = ''; // '' = semua, 'belum_dimulai', 'berjalan', 'selesai'

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setStatus($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function render()
    {
        // Query utama dengan relasi Ormawa
        $query = Proker::with('ormawa')
            ->when($this->search, function ($q) {
                $q->where('nama_proker', 'like', '%' . $this->search . '%')
                  ->orWhereHas('ormawa', function ($subQ) {
                      $subQ->where('nama', 'like', '%' . $this->search . '%');
                  });
            })
            ->when($this->filterStatus, function ($q) {
                $q->where('status', $this->filterStatus);
            });

        $prokers = $query->orderBy('target_waktu', 'asc')->paginate(10);

        // Menghitung statistik untuk Header Cards
        $totalProker = Proker::count();
        $selesai = Proker::where('status', 'selesai')->count();
        $berjalan = Proker::where('status', 'berjalan')->count();
        $tertunda = Proker::where('status', 'belum_dimulai')->count();
        
        $successRate = $totalProker > 0 ? round(($selesai / $totalProker) * 100) : 0;

        return view('livewire.admin.program-kerja', [
            'prokers' => $prokers,
            'stats' => [
                'successRate' => $successRate,
                'berjalan' => $berjalan,
                'tertunda' => $tertunda,
            ]
        ]);
    }
}