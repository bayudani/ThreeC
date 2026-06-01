<?php

namespace App\Livewire\Ormawa;

use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class ProgramKerja extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public $showForm = false;
    public $editId = null;
    public $nama_proker;
    public $deskripsi;
    public $target_waktu;
    public $status = 'belum_dimulai';
    public $progress = 0;

    protected function rules()
    {
        return [
            'nama_proker' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'target_waktu' => 'required|date',
            'status' => 'required|in:belum_dimulai,berjalan,selesai',
            'progress' => 'required|integer|min:0|max:100',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function resetForm()
    {
        $this->showForm = false;
        $this->editId = null;
        $this->nama_proker = null;
        $this->deskripsi = null;
        $this->target_waktu = null;
        $this->status = 'belum_dimulai';
        $this->progress = 0;
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($id);
        $this->editId = $proker->id;
        $this->nama_proker = $proker->nama_proker;
        $this->deskripsi = $proker->deskripsi;
        $this->target_waktu = $proker->target_waktu->format('Y-m-d');
        $this->status = $proker->status;
        $this->progress = $proker->progress;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();
        $ormawaId = Auth::user()->ormawa_id;

        if ($this->editId) {
            $proker = Proker::where('ormawa_id', $ormawaId)->findOrFail($this->editId);
            $proker->update([
                'nama_proker' => $this->nama_proker,
                'deskripsi' => $this->deskripsi,
                'target_waktu' => $this->target_waktu,
                'status' => $this->status,
                'progress' => $this->progress,
            ]);
        } else {
            Proker::create([
                'ormawa_id' => $ormawaId,
                'nama_proker' => $this->nama_proker,
                'deskripsi' => $this->deskripsi,
                'target_waktu' => $this->target_waktu,
                'status' => $this->status,
                'progress' => $this->progress,
            ]);
        }

        $this->resetForm();
        session()->flash('success', $this->editId ? 'Proker berhasil diperbarui.' : 'Proker berhasil ditambahkan.');
    }

    public function delete($id)
    {
        Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($id)->delete();
        session()->flash('success', 'Proker berhasil dihapus.');
    }

    public function render()
    {
        $ormawaId = Auth::user()->ormawa_id;

        $prokers = Proker::where('ormawa_id', $ormawaId)
            ->withCount('dokumentasis')
            ->when($this->search, fn($q) => $q->where('nama_proker', 'like', "%{$this->search}%"))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => Proker::where('ormawa_id', $ormawaId)->count(),
            'selesai' => Proker::where('ormawa_id', $ormawaId)->where('status', 'selesai')->count(),
            'berjalan' => Proker::where('ormawa_id', $ormawaId)->where('status', 'berjalan')->count(),
            'belum' => Proker::where('ormawa_id', $ormawaId)->where('status', 'belum_dimulai')->count(),
        ];

        return view('livewire.ormawa.program-kerja', compact('prokers', 'stats'));
    }
}
