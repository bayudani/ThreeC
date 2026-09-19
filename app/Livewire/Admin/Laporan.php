<?php

namespace App\Livewire\Admin;

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
    public $filterOrmawa = '';
    public $filterJenis = '';

    // Upload
    public $showUpload = false;
    public $proker_id;
    public $file;
    public $keterangan;

    // Preview
    public $previewUrl = null;
    public $previewKeterangan = null;

    public function updatingSearch() { $this->resetPage(); }
    public function setOrmawa($ormawaId) { $this->filterOrmawa = $ormawaId; $this->resetPage(); }
    public function setJenis($jenis) { $this->filterJenis = $jenis; $this->resetPage(); }

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

        $path = $this->file->store('laporan', 'public');

        Dokumentasi::create([
            'proker_id' => $this->proker_id,
            'file_path' => $path,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetUpload();
        session()->flash('success', 'Laporan berhasil diunggah.');
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
        $dok = Dokumentasi::findOrFail($id);
        $this->previewUrl = Storage::url($dok->file_path);
        $this->previewKeterangan = $dok->keterangan;
    }

    public function tutupPreview()
    {
        $this->previewUrl = null;
        $this->previewKeterangan = null;
    }

    public function render()
    {
        $user = Auth::user();

        $query = Dokumentasi::with(['proker.ormawa'])
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->whereHas('proker', function ($sub2) {
                        $sub2->where('nama_proker', 'like', '%' . $this->search . '%')
                            ->orWhereHas('ormawa', function ($sub3) {
                                $sub3->where('nama', 'like', '%' . $this->search . '%');
                            });
                    })->orWhere('keterangan', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterOrmawa, function ($q) {
                $q->whereHas('proker', function ($sub) {
                    $sub->where('ormawa_id', $this->filterOrmawa);
                });
            })
            ->when($user->role === 'admin_ormawa', function ($q) use ($user) {
                $q->whereHas('proker', function ($sub) use ($user) {
                    $sub->where('ormawa_id', $user->ormawa_id);
                });
            });

        $totalLaporan = (clone $query)->count();
        $laporan = $query->latest()->paginate(12);

        $stats = [
            'total' => $totalLaporan,
            'bulanIni' => (clone $query)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'gambar' => (clone $query)->get()->filter(fn($d) => in_array(strtolower(pathinfo($d->file_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif']))->count(),
            'dokumen' => (clone $query)->get()->filter(fn($d) => in_array(strtolower(pathinfo($d->file_path, PATHINFO_EXTENSION)), ['pdf', 'doc', 'docx', 'xls', 'xlsx']))->count(),
        ];

        $ormawas = \App\Models\Ormawa::orderBy('nama')->get(['id', 'nama']);

        $prokers = [];
        if ($user->role === 'admin_ormawa') {
            $prokers = Proker::where('ormawa_id', $user->ormawa_id)->orderBy('nama_proker')->get(['id', 'nama_proker']);
        }

        return view('livewire.admin.laporan', [
            'laporan' => $laporan,
            'stats' => $stats,
            'ormawas' => $ormawas,
            'prokers' => $prokers,
        ]);
    }
}
