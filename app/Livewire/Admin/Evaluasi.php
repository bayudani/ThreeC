<?php

namespace App\Livewire\Admin;

use App\Models\Ormawa;
use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Evaluasi extends Component
{
    use WithPagination;

    public $periode = '';
    public $search = '';
    public $filterKategori = '';

    public function filterByPeriode($periode)
    {
        $this->periode = $periode;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setKategori($kategori)
    {
        $this->filterKategori = $kategori;
        $this->resetPage();
    }

    public function render()
    {
        $ormawas = Ormawa::query()
            ->when($this->periode, fn($q) => $q->where('periode', $this->periode))
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->when($this->filterKategori, fn($q) => $q->where('kategori', $this->filterKategori))
            ->withCount(['prokers as total_proker'])
            ->withCount(['prokers as proker_selesai' => fn($q) => $q->where('status', 'selesai')])
            ->withCount(['prokers as proker_berjalan' => fn($q) => $q->where('status', 'berjalan')])
            ->withCount(['prokers as proker_belum' => fn($q) => $q->where('status', 'belum_dimulai')])
            ->orderBy('nama')
            ->paginate(10);

        $totalOrmawa = Ormawa::when($this->periode, fn($q) => $q->where('periode', $this->periode))
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->when($this->filterKategori, fn($q) => $q->where('kategori', $this->filterKategori))
            ->count();

        $allStats = Ormawa::when($this->periode, fn($q) => $q->where('periode', $this->periode))
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->when($this->filterKategori, fn($q) => $q->where('kategori', $this->filterKategori))
            ->withCount(['prokers as total_proker'])
            ->withCount(['prokers as proker_selesai' => fn($q) => $q->where('status', 'selesai')])
            ->get();

        $totalProker = $allStats->sum('total_proker');
        $totalSelesai = $allStats->sum('proker_selesai');
        $totalBerjalan = $allStats->sum('proker_berjalan');
        $totalBelum = $allStats->sum('proker_belum');
        $successRate = $totalProker > 0 ? round(($totalSelesai / $totalProker) * 100) : 0;

        $periodeList = Ormawa::whereNotNull('periode')->distinct()->orderBy('periode', 'desc')->pluck('periode');

        return view('livewire.admin.evaluasi', compact(
            'ormawas', 'totalOrmawa', 'totalProker', 'totalSelesai',
            'totalBerjalan', 'totalBelum', 'successRate', 'periodeList'
        ));
    }
}
