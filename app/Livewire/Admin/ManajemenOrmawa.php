<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use App\Models\Ormawa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class ManajemenOrmawa extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterKategori = '';
    public $viewMode = 'card';

    // Modal & Form
    public $showForm = false;
    public $editId = null;
    public $nama;
    public $kategori;
    public $fakultas;
    public $periode;
    public $logo;
    public $existingLogo;

    // Konfirmasi hapus
    public $confirmDeleteId = null;

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'fakultas' => 'nullable|string|max:255',
            'periode' => 'nullable|string|max:50',
            'logo' => 'nullable|image|max:2048',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setKategori($kategori)
    {
        $this->filterKategori = $kategori;
        $this->resetPage();
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    public function tambah()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $ormawa = Ormawa::findOrFail($id);
        $this->editId = $ormawa->id;
        $this->nama = $ormawa->nama;
        $this->kategori = $ormawa->kategori;
        $this->fakultas = $ormawa->fakultas;
        $this->periode = $ormawa->periode;
        $this->existingLogo = $ormawa->logo;
        $this->logo = null;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'kategori' => $this->kategori,
            'fakultas' => $this->fakultas,
            'periode' => $this->periode,
        ];

        if ($this->logo) {
            if ($this->editId && $this->existingLogo) {
                Storage::disk('public')->delete($this->existingLogo);
            }
            $data['logo'] = $this->logo->store('logos', 'public');
        }

        if ($this->editId) {
            Ormawa::where('id', $this->editId)->update($data);
            session()->flash('success', 'Ormawa berhasil diperbarui.');
        } else {
            $ormawa = Ormawa::create($data);

            $username = strtolower(str_replace(' ', '', $ormawa->nama));
            $password = $username . 'unsera@26';

            User::create([
                'name' => "Admin {$ormawa->nama}",
                'username' => $username,
                // 'email' => "{$username}@unsera.ac.id",
                'password' => Hash::make($password),
                'role' => 'admin_ormawa',
                'ormawa_id' => $ormawa->id,
            ]);

            session()->flash('success', "Ormawa berhasil ditambahkan. Akun: {$username} / {$password}");
        }

        $this->resetForm();
    }

    public function batal()
    {
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        $ormawa = Ormawa::findOrFail($this->confirmDeleteId);
        if ($ormawa->logo) {
            Storage::disk('public')->delete($ormawa->logo);
        }
        User::where('ormawa_id', $ormawa->id)->delete();
        $ormawa->delete();
        $this->confirmDeleteId = null;
        session()->flash('success', 'Ormawa beserta akun penggunanya berhasil dihapus.');
    }

    public function batalHapus()
    {
        $this->confirmDeleteId = null;
    }

    private function resetForm()
    {
        $this->showForm = false;
        $this->editId = null;
        $this->nama = null;
        $this->kategori = null;
        $this->fakultas = null;
        $this->periode = null;
        $this->logo = null;
        $this->existingLogo = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Ormawa::query()
            ->when($this->search, function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('fakultas', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterKategori, function ($q) {
                $q->where('kategori', $this->filterKategori);
            });

        $ormawas = $query->latest()->paginate(11);

        $stats = [
            'total' => Ormawa::count(),
            'legislatif' => Ormawa::where('kategori', 'Legislatif')->count(),
            'eksekutif' => Ormawa::where('kategori', 'Eksekutif')->count(),
            'ukm' => Ormawa::where('kategori', 'UKM')->count(),
        ];

        return view('livewire.admin.manajemen-ormawa', [
            'ormawas' => $ormawas,
            'stats' => $stats
        ]);
    }
}
