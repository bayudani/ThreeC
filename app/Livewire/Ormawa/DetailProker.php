<?php

namespace App\Livewire\Ormawa;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Proker;
use App\Models\Dokumentasi;

#[Layout('layouts.app')]
class DetailProker extends Component
{
    use WithFileUploads;

    public Proker $proker;
    
    // State Progress (computed dari tahapan)
    public $tahapan_saat_ini = 'perencanaan';
    public $progress = 0;

    // State Upload
    #[Rule('required|file|mimes:jpg,jpeg,png,pdf|max:5120', message: 'File maksimal 5MB (JPG/PNG/PDF)')]
    public $file_bukti;
    
    #[Rule('required|string|max:255', message: 'Keterangan wajib diisi.')]
    public $keterangan_file;

    public function mount($id)
    {
        // Pastikan proker ini hanya bisa diakses oleh ormawa yang bersangkutan
        $this->proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($id);
        
        $this->tahapan_saat_ini = $this->proker->tahapan_saat_ini;
        $this->progress = $this->proker->progress;
    }

    public function updatedTahapanSaatIni($value)
    {
        // Auto-update progress berdasarkan tahapan
        $this->progress = match($value) {
            'perencanaan' => 0,
            'persiapan' => 25,
            'pelaksanaan' => 50,
            'evaluasi' => 75,
            'selesai' => 100,
            default => 0,
        };
    }

    public function updateProgress()
    {
        if ($this->proker->isPending()) {
            session()->flash('error', 'Program kerja masih menunggu validasi admin.');
            return;
        }
        if ($this->proker->isRejected()) {
            session()->flash('error', 'Program kerja ditolak: ' . $this->proker->rejection_reason);
            return;
        }

        $this->validate([
            'tahapan_saat_ini' => 'required|in:perencanaan,persiapan,pelaksanaan,evaluasi,selesai'
        ]);

        // Update tahapan, progress, dan status otomatis
        $this->proker->update([
            'tahapan_saat_ini' => $this->tahapan_saat_ini,
            'progress' => $this->proker->computed_progress,
            'status' => $this->proker->computed_status,
        ]);

        session()->flash('success_progress', 'Tahapan berhasil diperbarui!');
    }

    public function uploadDokumen()
    {
        if ($this->proker->isPending()) {
            session()->flash('error', 'Program kerja masih menunggu validasi admin.');
            return;
        }
        if ($this->proker->isRejected()) {
            session()->flash('error', 'Program kerja ditolak: ' . $this->proker->rejection_reason);
            return;
        }

        $this->validateOnly('file_bukti');
        $this->validateOnly('keterangan_file');

        $path = $this->file_bukti->store('dokumentasi', 'public');

        Dokumentasi::create([
            'proker_id' => $this->proker->id,
            'file_path' => $path,
            'keterangan' => $this->keterangan_file
        ]);

        $this->reset(['file_bukti', 'keterangan_file']);
        session()->flash('success_dokumen', 'Dokumen berhasil diunggah!');
    }

    public function hapusDokumen($id)
    {
        if ($this->proker->isPending() || $this->proker->isRejected()) {
            session()->flash('error', 'Tidak dapat mengubah dokumen pada program yang belum divalidasi.');
            return;
        }

        $dokumen = Dokumentasi::where('proker_id', $this->proker->id)->findOrFail($id);
        Storage::disk('public')->delete($dokumen->file_path);
        $dokumen->delete();

        session()->flash('success_dokumen', 'Dokumen berhasil dihapus.');
    }

    public function render()
    {
        // Load relasi dokumentasi agar selalu up to date
        $this->proker->load('dokumentasis');
        
        return view('livewire.ormawa.detail-proker');
    }
}