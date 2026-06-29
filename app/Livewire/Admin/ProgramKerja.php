<?php

namespace App\Livewire\Admin;

use App\Models\Proker;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProgramKerja extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public $showRejectModal = false;
    public $rejectProkerId = null;
    public $rejection_reason = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setStatus($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function approveProker($id)
    {
        $proker = Proker::findOrFail($id);
        $proker->update([
            'validated_at' => now(),
            'status' => 'berjalan',
            'rejection_reason' => null,
        ]);
        session()->flash('success', 'Program kerja berhasil divalidasi!');
    }

    public function openRejectModal($id)
    {
        $this->rejectProkerId = $id;
        $this->rejection_reason = '';
        $this->showRejectModal = true;
    }

    public function closeRejectModal()
    {
        $this->showRejectModal = false;
        $this->rejectProkerId = null;
        $this->rejection_reason = '';
    }

    public function rejectProker()
    {
        $this->validate([
            'rejection_reason' => 'required|string|min:3',
        ]);

        $proker = Proker::findOrFail($this->rejectProkerId);
        $proker->update([
            'validated_at' => null,
            'rejection_reason' => $this->rejection_reason,
        ]);

        $this->closeRejectModal();
        session()->flash('success', 'Program kerja ditolak.');
    }

    public function render()
    {
        $query = Proker::with('ormawa')
            ->when($this->search, function ($q) {
                $q->where('nama_proker', 'like', '%' . $this->search . '%')
                  ->orWhereHas('ormawa', function ($subQ) {
                      $subQ->where('nama', 'like', '%' . $this->search . '%');
                  });
            })
            ->when($this->filterStatus, function ($q) {
                if ($this->filterStatus === 'menunggu_validasi') {
                    $q->whereNull('validated_at')->whereNull('rejection_reason');
                } elseif ($this->filterStatus === 'ditolak') {
                    $q->whereNotNull('rejection_reason');
                } else {
                    $q->where('status', $this->filterStatus)->whereNotNull('validated_at');
                }
            });

        $prokers = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalProker = Proker::count();
        $selesai = Proker::where('status', 'selesai')->whereNotNull('validated_at')->count();
        $berjalan = Proker::where('status', 'berjalan')->whereNotNull('validated_at')->count();
        $tertunda = Proker::whereNull('validated_at')->whereNull('rejection_reason')->count();
        $ditolak = Proker::whereNotNull('rejection_reason')->count();
        $totalValidated = $selesai + $berjalan;
        $successRate = $totalValidated > 0 ? round(($selesai / max($totalValidated, 1)) * 100) : 0;

        return view('livewire.admin.program-kerja', [
            'prokers' => $prokers,
            'stats' => [
                'successRate' => $successRate,
                'berjalan' => $berjalan,
                'tertunda' => $tertunda,
                'ditolak' => $ditolak,
            ]
        ]);
    }
}
