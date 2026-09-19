<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ormawa;
use App\Models\Proker;
use Illuminate\Support\Facades\Auth;

class TopbarSearch extends Component
{
    public $query = '';
    public $results = [];
    public $showDropdown = false;

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            $this->showDropdown = false;
            return;
        }

        $keyword = '%' . $this->query . '%';
        $user = Auth::user();
        $isAdmin = $user->role === 'admin_kampus';

        // Ormawa hanya boleh melihat data ormawanya sendiri
        $ormawas = collect();
        if ($isAdmin) {
            $ormawas = Ormawa::where('nama', 'like', $keyword)
                ->limit(3)
                ->get()
                ->map(fn($o) => [
                    'type' => 'Ormawa',
                    'label' => $o->nama,
                    'sub' => $o->kategori,
                    'url' => route('admin.ormawa'),
                ]);
        }

        $prokers = Proker::with('ormawa')
            ->where('nama_proker', 'like', $keyword)
            ->when(!$isAdmin, fn($q) => $q->where('ormawa_id', $user->ormawa_id))
            ->limit(5)
            ->get()
            ->map(fn($p) => [
                'type' => 'Proker',
                'label' => $p->nama_proker,
                'sub' => $p->ormawa?->nama ?? '-',
                'url' => $isAdmin
                    ? route('admin.proker.detail', $p->id)
                    : route('ormawa.proker.detail', $p->id),
            ]);

        $this->results = $ormawas->concat($prokers)->take(7)->values()->all();
        $this->showDropdown = count($this->results) > 0;
    }

    public function selectResult($url)
    {
        // Hanya izinkan redirect ke URL internal aplikasi (cegah open redirect)
        if (!str_starts_with($url, url('/'))) {
            return;
        }

        $this->query = '';
        $this->results = [];
        $this->showDropdown = false;
        $this->redirect($url);
    }

    public function render()
    {
        return view('livewire.topbar-search');
    }
}
