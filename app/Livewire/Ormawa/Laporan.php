<?php

namespace App\Livewire\Ormawa;

use App\Models\Dokumentasi;
use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Laporan extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterProker = '';

    public $showUpload = false;
    public $proker_id;
    public $file;
    public $keterangan;

    public $previewUrl = null;
    public $previewKeterangan = null;

    public function updatingSearch() { $this->resetPage(); }

    public function rules()
    {
        return [
            'proker_id' => 'required|exists:prokers,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp,gif|max:10240',
            'keterangan' => 'nullable|string|max:255',
        ];
    }

    public function upload()
    {
        $this->validate();

        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($this->proker_id);
        $path = $this->file->store('laporan', 'public');

        Dokumentasi::create([
            'proker_id' => $proker->id,
            'file_path' => $path,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetUpload();
        session()->flash('success', 'Dokumen berhasil diunggah.');
    }

    public function resetUpload()
    {
        $this->showUpload = false;
        $this->proker_id = null;
        $this->file = null;
        $this->keterangan = null;
        $this->resetErrorBag();
    }

    public function preview($id)
    {
        $dok = Dokumentasi::whereHas('proker', fn($q) => $q->where('ormawa_id', Auth::user()->ormawa_id))->findOrFail($id);
        $this->previewUrl = Storage::url($dok->file_path);
        $this->previewKeterangan = $dok->keterangan;
    }

    public function tutupPreview()
    {
        $this->previewUrl = null;
        $this->previewKeterangan = null;
    }

    public function delete($id)
    {
        $dok = Dokumentasi::whereHas('proker', fn($q) => $q->where('ormawa_id', Auth::user()->ormawa_id))->findOrFail($id);
        Storage::disk('public')->delete($dok->file_path);
        $dok->delete();
        session()->flash('success', 'Dokumen berhasil dihapus.');
    }

    public function render()
    {
        $ormawaId = Auth::user()->ormawa_id;

        $query = Dokumentasi::whereHas('proker', fn($q) => $q->where('ormawa_id', $ormawaId))
            ->with(['proker'])
            ->when($this->search, function ($q) {
                $q->whereHas('proker', fn($sub) => $sub->where('nama_proker', 'like', "%{$this->search}%"))
                  ->orWhere('keterangan', 'like', "%{$this->search}%");
            })
            ->when($this->filterProker, fn($q) => $q->where('proker_id', $this->filterProker));

        $totalLaporan = (clone $query)->count();
        $laporan = $query->latest()->paginate(12);

        $stats = [
            'total' => $totalLaporan,
            'bulanIni' => (clone $query)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
        ];

        $prokers = Proker::where('ormawa_id', $ormawaId)->orderBy('nama_proker')->get(['id', 'nama_proker']);

        return view('livewire.ormawa.laporan', compact('laporan', 'stats', 'prokers'));
    }
}
