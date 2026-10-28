<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Ormawa;
use App\Models\Fakultas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

#[Layout('layouts.app')]
class ManajemenOrmawa extends Component
{
    use WithPagination, WithFileUploads;

    public $pageType = 'ormawa';
    public $search = '';
    public $filterKategori = '';
    public $viewMode = 'table';

    public function mount()
    {
        if (request()->route()->getName() === 'admin.ukm') {
            $this->pageType = 'ukm';
            $this->filterKategori = 'UKM';
        }
    }

    // Modal & Form
    public $showForm = false;
    public $editId = null;
    public $nama;
    public $kategori;
    public $fakultas_id;
    public $periode;
    public $logo;
    public $existingLogo;

    // Konfirmasi hapus
    public $confirmDeleteId = null;

    protected function rules()
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255', Rule::unique('ormawas', 'nama')->ignore($this->editId)],
            'kategori' => 'required|string|max:50',
            'logo' => 'nullable|image|max:2048',
        ];

        // UKM: fakultas auto (Universitas), periode optional
        if ($this->pageType === 'ukm' || $this->kategori === 'UKM') {
            $rules['periode'] = 'nullable|string|max:50';
        } else {
            // Ormawa: fakultas & periode required
            $rules['fakultas_id'] = 'required|exists:fakultas,id';
            $rules['periode'] = 'required|string|max:50';
        }

        return $rules;
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
        if ($this->pageType === 'ukm') {
            $this->kategori = 'UKM';
            // UKM auto ke fakultas Universitas
            $universitas = Fakultas::where('kode', 'UNSERA')->first();
            $this->fakultas_id = $universitas?->id;
        }
        $this->showForm = true;
    }

    public function edit($id)
    {
        $ormawa = Ormawa::with('fakultas')->findOrFail($id);
        $this->editId = $ormawa->id;
        $this->nama = $ormawa->nama;
        $this->kategori = $ormawa->kategori;
        $this->fakultas_id = $ormawa->fakultas_id;
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
            'periode' => $this->periode,
        ];

        // UKM: fakultas auto ke Universitas
        if ($this->kategori === 'UKM') {
            $universitas = Fakultas::where('kode', 'UNSERA')->first();
            $data['fakultas_id'] = $universitas?->id;
        } else {
            $data['fakultas_id'] = $this->fakultas_id;
        }

        if ($this->logo) {
            if ($this->editId && $this->existingLogo) {
                Storage::disk('public')->delete($this->existingLogo);
            }
            $data['logo'] = $this->logo->store('logos', 'public');
        }

        if ($this->editId) {
            Ormawa::where('id', $this->editId)->update($data);
            session()->flash('success', 'Data berhasil diperbarui.');
        } else {
            $ormawa = Ormawa::create($data);

            $username = $this->generateUsername($ormawa->nama);
            $password = $username . '@unsera26';

            User::create([
                'name' => "Admin {$ormawa->nama}",
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'admin_ormawa',
                'ormawa_id' => $ormawa->id,
            ]);

            session()->flash('success', "Berhasil ditambahkan. Akun: {$username} / {$password}");
        }

        $this->resetForm();
    }

    private function generateUsername(string $nama): string
    {
        $base = strtolower(preg_replace('/[^a-z0-9]/i', '', $nama));
        if ($base === '') {
            $base = 'ormawa';
        }

        $username = $base;
        $i = 1;
        while (User::where('username', $username)->exists()) {
            $username = $base . $i;
            $i++;
        }

        return $username;
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
        session()->flash('success', 'Data beserta akun berhasil dihapus.');
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
        $this->fakultas_id = null;
        $this->periode = null;
        $this->logo = null;
        $this->existingLogo = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $fakultasList = Fakultas::where('is_active', true)->orderBy('nama')->get();
        
        // Dropdown periode: 10 tahun (2024-2025 s/d 2034-2035)
        $periodeList = [];
        for ($year = 2024; $year <= 2034; $year++) {
            $periodeList[] = $year . '-' . ($year + 1);
        }

        if ($this->pageType === 'ukm') {
            $query = Ormawa::with('fakultas')
                ->where('kategori', 'UKM')
                ->when($this->search, function ($q) {
                    $q->where(function ($sub) {
                        $sub->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhereHas('fakultas', fn($fq) => $fq->where('nama', 'like', '%' . $this->search . '%'));
                    });
                });

            $ormawas = $query->with('users')->latest()->paginate(11);

            $stats = [
                'total' => Ormawa::where('kategori', 'UKM')->count(),
                'legislatif' => 0,
                'eksekutif' => 0,
            ];
        } else {
            $query = Ormawa::with('fakultas')
                ->where('kategori', '!=', 'UKM')
                ->when($this->search, function ($q) {
                    $q->where(function ($sub) {
                        $sub->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhereHas('fakultas', fn($fq) => $fq->where('nama', 'like', '%' . $this->search . '%'));
                    });
                })
                ->when($this->filterKategori, function ($q) {
                    $q->where('kategori', $this->filterKategori);
                });

            $ormawas = $query->with('users')->latest()->paginate(11);

            $stats = [
                'total' => Ormawa::where('kategori', '!=', 'UKM')->count(),
                'legislatif' => Ormawa::where('kategori', 'Legislatif')->count(),
                'eksekutif' => Ormawa::where('kategori', 'Eksekutif')->count(),
            ];
        }

        return view('livewire.admin.manajemen-ormawa', [
            'ormawas' => $ormawas,
            'stats' => $stats,
            'fakultasList' => $fakultasList,
            'periodeList' => $periodeList,
        ]);
    }
}
