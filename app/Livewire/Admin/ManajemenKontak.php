<?php

namespace App\Livewire\Admin;

use App\Models\KontakAdmin;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ManajemenKontak extends Component
{
    // Satu input per jenis kontak
    public $email = '';
    public $whatsapp = '';
    public $instagram = '';
    public $tiktok = '';
    public $telepon = '';
    public $website = '';

    // Urutan tampil di footer (kecil = lebih dulu)
    public array $urutanMap = [
        'email' => 1,
        'whatsapp' => 2,
        'instagram' => 3,
        'tiktok' => 4,
        'telepon' => 5,
        'website' => 6,
    ];

    public array $labelMap = [
        'email' => 'Email',
        'whatsapp' => 'WhatsApp',
        'instagram' => 'Instagram',
        'tiktok' => 'TikTok',
        'telepon' => 'Telepon',
        'website' => 'Website',
    ];

    public function mount()
    {
        foreach (array_keys($this->labelMap) as $jenis) {
            $kontak = KontakAdmin::where('icon', $jenis)->first();
            $this->{$jenis} = $kontak?->value ?? '';
        }
    }

    public function save()
    {
        $this->validate([
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:50',
            'tiktok' => 'nullable|string|max:50',
            'telepon' => 'nullable|string|max:30',
            'website' => 'nullable|url|max:255',
        ]);

        foreach (array_keys($this->labelMap) as $jenis) {
            $value = trim($this->{$jenis});

            if ($value === '') {
                // Kosong = hapus dari tampilan
                KontakAdmin::where('icon', $jenis)->delete();
                continue;
            }

            KontakAdmin::updateOrCreate(
                ['icon' => $jenis],
                [
                    'label' => $this->labelMap[$jenis],
                    'value' => $value,
                    'urutan' => $this->urutanMap[$jenis],
                    'is_active' => true,
                ]
            );
        }

        session()->flash('success', 'Kontak berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.manajemen-kontak');
    }
}
