<?php

namespace App\Livewire\Admin;

use App\Models\Fakultas;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ManajemenFakultas extends Component
{
    use WithPagination;

    public $showForm = false;
    public $editId = null;
    public $confirmDeleteId = null;

    public $nama;
    public $kode;
    public $is_active = true;

    public $search = '';

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->editId = $id;

        if ($id) {
            $fakultas = Fakultas::findOrFail($id);
            $this->nama = $fakultas->nama;
            $this->kode = $fakultas->kode;
            $this->is_active = $fakultas->is_active;
        } else {
            $this->reset(['nama', 'kode']);
            $this->is_active = true;
        }

        $this->showForm = true;
    }

    public function save()
    {
        $this->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('fakultas', 'nama')->ignore($this->editId)],
            'kode' => ['required', 'string', 'max:10', Rule::unique('fakultas', 'kode')->ignore($this->editId)],
            'is_active' => 'boolean',
        ]);

        if ($this->editId) {
            Fakultas::findOrFail($this->editId)->update([
                'nama' => $this->nama,
                'kode' => $this->kode,
                'is_active' => $this->is_active,
            ]);
            session()->flash('success', 'Fakultas berhasil diperbarui.');
        } else {
            Fakultas::create([
                'nama' => $this->nama,
                'kode' => $this->kode,
                'is_active' => $this->is_active,
            ]);
            session()->flash('success', 'Fakultas berhasil ditambahkan.');
        }

        $this->batal();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        $fakultas = Fakultas::findOrFail($this->confirmDeleteId);
        
        if ($fakultas->ormawas()->count() > 0) {
            session()->flash('error', 'Fakultas tidak dapat dihapus karena masih digunakan oleh ormawa.');
            $this->confirmDeleteId = null;
            return;
        }

        $fakultas->delete();
        session()->flash('success', 'Fakultas berhasil dihapus.');
        $this->confirmDeleteId = null;
    }

    public function batal()
    {
        $this->showForm = false;
        $this->editId = null;
        $this->reset(['nama', 'kode']);
        $this->is_active = true;
    }

    public function batalHapus()
    {
        $this->confirmDeleteId = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $fakultas = Fakultas::query()
            ->when($this->search, fn($q) => $q->where(function($sub) {
                $sub->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('kode', 'like', '%' . $this->search . '%');
            }))
            ->orderBy('nama')
            ->paginate(10);

        return view('livewire.admin.manajemen-fakultas', [
            'fakultas' => $fakultas,
        ]);
    }
}
