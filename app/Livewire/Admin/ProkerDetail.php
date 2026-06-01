<?php

namespace App\Livewire\Admin;

use App\Models\Proker;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProkerDetail extends Component
{
    public Proker $proker;

    public function mount($id)
    {
        $this->proker = Proker::with(['ormawa', 'dokumentasis'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.proker-detail');
    }
}
