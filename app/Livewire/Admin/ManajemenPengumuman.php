<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use App\Models\Pengumuman;

#[Layout('layouts.app')]
class ManajemenPengumuman extends Component
{
    public $isModalOpen = false;

    #[Rule('required|min:5', message: 'Judul pengumuman wajib diisi minimal 5 karakter.')]
    public $judul;

    #[Rule('required', message: 'Isi pengumuman wajib diisi.')]
    public $isi;

    #[Rule('required|in:mendesak,info,kegiatan')]
    public $tipe = 'info';

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['judul', 'isi']);
        $this->tipe = 'info';
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function simpan()
    {
        $this->validate();

        Pengumuman::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
            'tipe' => $this->tipe,
            'is_active' => true,
        ]);

        $this->closeModal();
        session()->flash('success', 'Pengumuman berhasil disiarkan ke seluruh Ormawa!');
    }

    public function hapus($id)
    {
        Pengumuman::find($id)?->delete();
        session()->flash('success', 'Pengumuman berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $pengumuman = Pengumuman::find($id);
        if ($pengumuman) {
            $pengumuman->update([
                'is_active' => !$pengumuman->is_active
            ]);
        }
    }

    public function render()
    {
        // Ambil semua pengumuman, urutkan dari yang paling baru
        $pengumumans = Pengumuman::latest()->get();

        return view('livewire.admin.manajemen-pengumuman', [
            'pengumumans' => $pengumumans
        ]);
    }
}