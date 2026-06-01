<?php

namespace App\Livewire\Admin;

use App\Models\Ormawa;
use App\Models\Proker;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Evaluasi extends Component
{
    public $periode = '';

    public function filterByPeriode($periode)
    {
        $this->periode = $periode;
    }

    public function render()
    {
        $ormawas = Ormawa::when($this->periode, fn($q) => $q->where('periode', $this->periode))
            ->withCount(['prokers as total_proker'])
            ->withCount(['prokers as proker_selesai' => fn($q) => $q->where('status', 'selesai')])
            ->withCount(['prokers as proker_berjalan' => fn($q) => $q->where('status', 'berjalan')])
            ->withCount(['prokers as proker_belum' => fn($q) => $q->where('status', 'belum_dimulai')])
            ->orderBy('nama')
            ->get();

        $totalOrmawa = $ormawas->count();
        $totalProker = $ormawas->sum('total_proker');
        $totalSelesai = $ormawas->sum('proker_selesai');
        $totalBerjalan = $ormawas->sum('proker_berjalan');
        $totalBelum = $ormawas->sum('proker_belum');
        $successRate = $totalProker > 0 ? round(($totalSelesai / $totalProker) * 100) : 0;

        $periodeList = Ormawa::whereNotNull('periode')->distinct()->orderBy('periode', 'desc')->pluck('periode');

        return view('livewire.admin.evaluasi', compact(
            'ormawas', 'totalOrmawa', 'totalProker', 'totalSelesai',
            'totalBerjalan', 'totalBelum', 'successRate', 'periodeList'
        ));
    }
}
