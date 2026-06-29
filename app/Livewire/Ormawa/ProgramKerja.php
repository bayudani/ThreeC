<?php

namespace App\Livewire\Ormawa;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Proker;
use App\Models\Dokumentasi;

#[Layout('layouts.app')]
class ProgramKerja extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';

    // State untuk Modal Update Progress
    public $isProgressModalOpen = false;
    public $proker_id;
    public $progress = 0;
    public $status = 'belum_dimulai';

    // State untuk Modal Upload Dokumentasi
    public $isDokumenModalOpen = false;
    
    #[Rule('required|file|mimes:jpg,jpeg,png,pdf|max:2048', message: 'File harus berupa JPG/PNG/PDF maksimal 2MB.')]
    public $file_bukti;
    
    #[Rule('required|string|max:255', message: 'Keterangan wajib diisi.')]
    public $keterangan_file;

    // ==========================================
    // STATE UNTUK MODAL BUAT PROKER
    // ==========================================
    public $isBuatModalOpen = false;

    #[Rule('required|min:5', message: 'Nama program kerja minimal 5 karakter.')]
    public $nama_proker;

    #[Rule('nullable|string', message: 'Deskripsi harus berupa teks.')]
    public $deskripsi;

    #[Rule('required|date', message: 'Target waktu wajib diisi dengan format tanggal.')]
    public $target_waktu;

    public function openBuatModal()
    {
        $this->resetValidation();
        $this->reset(['nama_proker', 'deskripsi', 'target_waktu']);
        $this->isBuatModalOpen = true;
    }

    public function closeBuatModal()
    {
        $this->isBuatModalOpen = false;
        $this->reset(['nama_proker', 'deskripsi', 'target_waktu']);
    }

    public function simpanProker()
    {
        $this->validate();

        Proker::create([
            'ormawa_id' => Auth::user()->ormawa_id,
            'nama_proker' => $this->nama_proker,
            'deskripsi' => $this->deskripsi,
            'target_waktu' => $this->target_waktu,
            'status' => 'belum_dimulai',
            'progress' => 0,
            'validated_at' => null,
        ]);

        $this->closeBuatModal();
        session()->flash('success', 'Program kerja berhasil didaftarkan! Silakan pantau progresnya.');
    }

    // ==========================================
    // LOGIKA PROGRESS
    // ==========================================
    public function openProgressModal($id)
    {
        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($id);
        if ($proker->isPending()) {
            session()->flash('error', 'Program kerja masih menunggu validasi admin.');
            return;
        }
        if ($proker->isRejected()) {
            session()->flash('error', 'Program kerja ditolak: ' . $proker->rejection_reason);
            return;
        }
        $this->proker_id = $proker->id;
        $this->progress = $proker->progress;
        $this->status = $proker->status;
        $this->isProgressModalOpen = true;
    }

    public function closeProgressModal()
    {
        $this->isProgressModalOpen = false;
        $this->reset(['proker_id', 'progress', 'status']);
    }

    public function updateProgress()
    {
        $this->validate([
            'progress' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:belum_dimulai,berjalan,selesai'
        ]);

        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($this->proker_id);
        
        // Auto-adjust status berdasarkan progress (opsional UX)
        if ($this->progress == 100) $this->status = 'selesai';
        if ($this->progress > 0 && $this->progress < 100 && $this->status == 'belum_dimulai') $this->status = 'berjalan';

        $proker->update([
            'progress' => $this->progress,
            'status' => $this->status
        ]);

        $this->closeProgressModal();
        session()->flash('success', 'Progress program kerja berhasil diperbarui!');
    }

    // ==========================================
    // LOGIKA UPLOAD DOKUMENTASI
    // ==========================================
    public function openDokumenModal($id)
    {
        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($id);
        if ($proker->isPending()) {
            session()->flash('error', 'Program kerja masih menunggu validasi admin.');
            return;
        }
        if ($proker->isRejected()) {
            session()->flash('error', 'Program kerja ditolak: ' . $proker->rejection_reason);
            return;
        }
        $this->proker_id = $proker->id;
        $this->isDokumenModalOpen = true;
    }

    public function closeDokumenModal()
    {
        $this->isDokumenModalOpen = false;
        $this->resetValidation();
        $this->reset(['proker_id', 'file_bukti', 'keterangan_file']);
    }

    public function uploadDokumen()
    {
        $this->validateOnly('file_bukti');
        $this->validateOnly('keterangan_file');

        // Simpan file ke folder storage/app/public/dokumentasi
        $path = $this->file_bukti->store('dokumentasi', 'public');

        Dokumentasi::create([
            'proker_id' => $this->proker_id,
            'file_path' => $path,
            'keterangan' => $this->keterangan_file
        ]);

        $this->closeDokumenModal();
        session()->flash('success', 'Bukti kegiatan berhasil diunggah!');
    }

    // ==========================================
    // RENDER VIEW
    // ==========================================
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $ormawaId = Auth::user()->ormawa_id;

        $prokers = Proker::with('dokumentasis')
            ->where('ormawa_id', $ormawaId)
            ->when($this->search, function($query) {
                $query->where('nama_proker', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(10);

        $totalProker = Proker::where('ormawa_id', $ormawaId)->count();
        $selesai = Proker::where('ormawa_id', $ormawaId)->where('status', 'selesai')->count();
        $berjalan = Proker::where('ormawa_id', $ormawaId)->where('status', 'berjalan')->count();
        $belumDimulai = Proker::where('ormawa_id', $ormawaId)->where('status', 'belum_dimulai')->count();

        $pending = Proker::where('ormawa_id', $ormawaId)->whereNull('validated_at')->whereNull('rejection_reason')->count();

        return view('livewire.ormawa.program-kerja', [
            'prokers' => $prokers,
            'stats' => [
                'total' => $totalProker,
                'selesai' => $selesai,
                'berjalan' => $berjalan,
                'belum_dimulai' => $belumDimulai,
                'pending' => $pending,
            ],
        ]);
    }
}