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

        $ormawas = Ormawa::where('nama', 'like', $keyword)
            ->limit(3)
            ->get()
            ->map(fn($o) => [
                'type' => 'Ormawa',
                'label' => $o->nama,
                'sub' => $o->kategori,
                'url' => $user->role === 'admin_kampus' ? route('admin.ormawa') : '#',
                'id' => null,
            ]);

        $prokers = Proker::with('ormawa')
            ->where('nama_proker', 'like', $keyword)
            ->limit(5)
            ->get()
            ->map(fn($p) => [
                'type' => 'Proker',
                'label' => $p->nama_proker,
                'sub' => $p->ormawa->nama,
                'url' => $user->role === 'admin_kampus'
                    ? route('admin.proker.detail', $p->id)
                    : route('ormawa.proker.detail', $p->id),
                'id' => $p->id,
            ]);

        $this->results = collect($ormawas)->concat($prokers)->take(7);
        $this->showDropdown = $this->results->isNotEmpty();
    }

    public function selectResult($url)
    {
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
