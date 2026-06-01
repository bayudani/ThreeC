<?php

namespace App\Livewire\Ormawa;

use App\Models\Proker;
use App\Models\Dokumentasi;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $ormawaId = $user->ormawa_id;

        $totalProker = Proker::where('ormawa_id', $ormawaId)->count();
        $selesai = Proker::where('ormawa_id', $ormawaId)->where('status', 'selesai')->count();
        $berjalan = Proker::where('ormawa_id', $ormawaId)->where('status', 'berjalan')->count();
        $belumDimulai = Proker::where('ormawa_id', $ormawaId)->where('status', 'belum_dimulai')->count();
        $successRate = $totalProker > 0 ? round(($selesai / $totalProker) * 100) : 0;

        $prokerTerbaru = Proker::where('ormawa_id', $ormawaId)->withCount('dokumentasis')->latest()->take(5)->get();

        $aktivitas = Dokumentasi::whereHas('proker', fn($q) => $q->where('ormawa_id', $ormawaId))
            ->with('proker')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($d) => [
                'proker' => $d->proker->nama_proker,
                'keterangan' => $d->keterangan,
                'waktu' => $d->created_at,
            ]);

        return view('livewire.ormawa.dashboard', compact(
            'totalProker', 'selesai', 'berjalan', 'belumDimulai',
            'successRate', 'prokerTerbaru', 'aktivitas', 'ormawaId'
        ));
    }
}
