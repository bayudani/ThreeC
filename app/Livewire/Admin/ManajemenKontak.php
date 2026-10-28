<?php

namespace App\Livewire\Admin;

use App\Models\KontakAdmin;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ManajemenKontak extends Component
{
    use WithPagination;

    public $showForm = false;
    public $editId = null;
    public $confirmDeleteId = null;

    public $label;
    public $value;
    public $icon;
    public $urutan = 0;
    public $is_active = true;

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->editId = $id;

        if ($id) {
            $kontak = KontakAdmin::findOrFail($id);
            $this->label = $kontak->label;
            $this->value = $kontak->value;
            $this->icon = $kontak->icon;
            $this->urutan = $kontak->urutan;
            $this->is_active = $kontak->is_active;
        } else {
            $this->reset(['label', 'value', 'icon']);
            $this->urutan = KontakAdmin::max('urutan') + 1;
            $this->is_active = true;
        }

        $this->showForm = true;
    }

    public function save()
    {
        $this->validate([
            'label' => 'required|string|max:50',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($this->editId) {
            KontakAdmin::findOrFail($this->editId)->update([
                'label' => $this->label,
                'value' => $this->value,
                'icon' => $this->icon,
                'urutan' => $this->urutan,
                'is_active' => $this->is_active,
            ]);
            session()->flash('success', 'Kontak berhasil diperbarui.');
        } else {
            KontakAdmin::create([
                'label' => $this->label,
                'value' => $this->value,
                'icon' => $this->icon,
                'urutan' => $this->urutan,
                'is_active' => $this->is_active,
            ]);
            session()->flash('success', 'Kontak berhasil ditambahkan.');
        }

        $this->batal();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        KontakAdmin::findOrFail($this->confirmDeleteId)->delete();
        session()->flash('success', 'Kontak berhasil dihapus.');
        $this->confirmDeleteId = null;
    }

    public function batal()
    {
        $this->showForm = false;
        $this->editId = null;
        $this->reset(['label', 'value', 'icon']);
        $this->urutan = 0;
        $this->is_active = true;
    }

    public function batalHapus()
    {
        $this->confirmDeleteId = null;
    }

    public function render()
    {
        $kontaks = KontakAdmin::orderBy('urutan')->paginate(10);

        return view('livewire.admin.manajemen-kontak', [
            'kontaks' => $kontaks,
        ]);
    }
}
