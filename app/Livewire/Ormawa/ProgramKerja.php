<?php

namespace App\Livewire\Ormawa;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Proker;
use App\Models\Dokumentasi;

#[Layout('layouts.app')]
class ProgramKerja extends Component
{
    use WithFileUploads;

    public $search = '';

    // State untuk Modal Update Progress
    public $isProgressModalOpen = false;
    public $proker_id;
    public $tahapan_saat_ini;

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

    #[Rule('required|string|min:10', message: 'Deskripsi wajib diisi minimal 10 karakter.')]
    public $deskripsi;

    #[Rule('required|date|after_or_equal:today', message: 'Target waktu wajib diisi dan minimal hari ini.')]
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
        // Validasi hanya field milik modal "Buat Proker".
        // Tidak boleh pakai $this->validate() tanpa argumen, karena akan
        // ikut memvalidasi $file_bukti & $keterangan_file (milik modal
        // Upload Bukti) yang pasti kosong saat menambah proker.
        $this->validate([
            'nama_proker'  => 'required|min:5',
            'deskripsi'    => 'required|string|min:10',
            'target_waktu' => 'required|date|after_or_equal:today',
        ]);

        Proker::create([
            'ormawa_id' => Auth::user()->ormawa_id,
            'nama_proker' => $this->nama_proker,
            'deskripsi' => $this->deskripsi,
            'target_waktu' => $this->target_waktu,
            'tahapan_saat_ini' => 'perencanaan',
            'status' => 'belum_dimulai',
            'progress' => 0,
            'validated_at' => null,
        ]);

        $this->closeBuatModal();
        session()->flash('success', 'Program kerja berhasil didaftarkan! Silakan pantau progresnya.');
    }

    // ==========================================
    // LOGIKA PROGRESS (UPDATE TAHAPAN)
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
        $this->tahapan_saat_ini = $proker->tahapan_saat_ini;
        $this->isProgressModalOpen = true;
    }

    public function closeProgressModal()
    {
        $this->isProgressModalOpen = false;
        $this->reset(['proker_id', 'tahapan_saat_ini']);
    }

    public function updateProgress()
    {
        $this->validate([
            'tahapan_saat_ini' => 'required|in:perencanaan,persiapan,pelaksanaan,evaluasi,selesai'
        ]);

        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($this->proker_id);
        
        $proker->update([
            'tahapan_saat_ini' => $this->tahapan_saat_ini,
            'progress' => $proker->computed_progress,
            'status' => $proker->computed_status,
        ]);

        $this->closeProgressModal();
        session()->flash('success', 'Tahapan program kerja berhasil diperbarui!');
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

        // Pastikan proker milik ormawa yang sedang login (cegah IDOR)
        $proker = Proker::where('ormawa_id', Auth::user()->ormawa_id)->findOrFail($this->proker_id);

        // Simpan file ke folder storage/app/public/dokumentasi
        $path = $this->file_bukti->store('dokumentasi', 'public');

        Dokumentasi::create([
            'proker_id' => $proker->id,
            'file_path' => $path,
            'keterangan' => $this->keterangan_file
        ]);

        $this->closeDokumenModal();
        session()->flash('success', 'Bukti kegiatan berhasil diunggah!');
    }

    // ==========================================
    // RENDER VIEW
    // ==========================================
    public function render()
    {
        $ormawaId = Auth::user()->ormawa_id;

        $prokers = Proker::with('dokumentasis')
            ->where('ormawa_id', $ormawaId)
            ->when($this->search, function ($query) {
                $query->where('nama_proker', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();

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