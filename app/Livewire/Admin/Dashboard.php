<?php

namespace App\Livewire\Admin;

use App\Models\Ormawa;
use App\Models\Proker;
use App\Models\Dokumentasi;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $periode = '';

    public function filterByPeriode($periode)
    {
        $this->periode = $periode;
    }

    public function render()
    {
        $totalOrmawa = Ormawa::when($this->periode, fn($q) => $q->where('periode', $this->periode))->count();
        $totalProker = Proker::when($this->periode, fn($q) => $q->whereHas('ormawa', fn($o) => $o->where('periode', $this->periode)))->count();
        $selesai = Proker::where('status', 'selesai')->when($this->periode, fn($q) => $q->whereHas('ormawa', fn($o) => $o->where('periode', $this->periode)))->count();
        $berjalan = Proker::where('status', 'berjalan')->when($this->periode, fn($q) => $q->whereHas('ormawa', fn($o) => $o->where('periode', $this->periode)))->count();
        $belumDimulai = Proker::where('status', 'belum_dimulai')->when($this->periode, fn($q) => $q->whereHas('ormawa', fn($o) => $o->where('periode', $this->periode)))->count();
        $successRate = $totalProker > 0 ? round(($selesai / $totalProker) * 100) : 0;

        $prokerPerKategori = Ormawa::selectRaw('kategori, count(prokers.id) as total')
            ->leftJoin('prokers', 'ormawas.id', '=', 'prokers.ormawa_id')
            ->when($this->periode, fn($q) => $q->where('ormawas.periode', $this->periode))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $aktivitas = Dokumentasi::with(['proker.ormawa'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($d) => [
                'ormawa' => $d->proker->ormawa->nama,
                'proker' => $d->proker->nama_proker,
                'waktu' => $d->created_at,
                'tipe' => 'Dokumen',
            ]);

        $prokerBaru = Proker::with('ormawa')->latest()->take(3)->get()->map(fn($p) => [
            'ormawa' => $p->ormawa->nama,
            'proker' => $p->nama_proker,
            'waktu' => $p->created_at,
            'tipe' => 'Proker Baru',
        ]);

        $aktivitas = $aktivitas->concat($prokerBaru)->sortByDesc(fn($a) => $a['waktu'])->take(5);

        $chartCategories = [];
        $chartData = [];
        foreach (['BEM', 'DPM', 'HIMA', 'UKM', 'MPM'] as $cat) {
            $total = $prokerPerKategori->get($cat, 0);
            if ($total > 0) {
                $chartCategories[] = $cat;
                $chartData[] = $total;
            }
        }

        $periodeList = Ormawa::whereNotNull('periode')->distinct()->orderBy('periode', 'desc')->pluck('periode');

        return view('livewire.admin.dashboard', [
            'totalOrmawa' => $totalOrmawa,
            'totalProker' => $totalProker,
            'selesai' => $selesai,
            'berjalan' => $berjalan,
            'belumDimulai' => $belumDimulai,
            'successRate' => $successRate,
            'aktivitas' => $aktivitas,
            'chartCategories' => $chartCategories,
            'chartData' => $chartData,
            'periodeList' => $periodeList,
        ]);
    }
}
