<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['ormawa_id', 'nama_proker', 'deskripsi', 'target_waktu', 'status', 'progress', 'tahapan_saat_ini', 'validated_at', 'rejection_reason'])]
class Proker extends Model
{
    public function ormawa(): BelongsTo {
        return $this->belongsTo(Ormawa::class);
    }

    public function dokumentasis(): HasMany {
        return $this->hasMany(Dokumentasi::class);
    }

    protected function casts(): array
    {
        return [
            'validated_at' => 'datetime',
        ];
    }

    // Auto-compute progress & status from tahapan
    public function getComputedProgressAttribute(): int
    {
        return match($this->tahapan_saat_ini) {
            'perencanaan' => 20,
            'persiapan' => 40,
            'pelaksanaan' => 60,
            'evaluasi' => 80,
            'selesai' => 100,
            default => 0,
        };
    }

    public function getComputedStatusAttribute(): string
    {
        if ($this->isRejected()) return 'ditolak';
        if ($this->isPending()) return 'menunggu_persetujuan';
        if ($this->tahapan_saat_ini === 'selesai') return 'selesai';
        return 'berjalan';
    }

    public static function tahapanOptions(): array
    {
        return [
            'perencanaan' => 'Perencanaan',
            'persiapan' => 'Persiapan',
            'pelaksanaan' => 'Pelaksanaan',
            'evaluasi' => 'Evaluasi',
            'selesai' => 'Selesai',
        ];
    }

    public function isPending(): bool
    {
        return is_null($this->validated_at) && is_null($this->rejection_reason);
    }

    public function isRejected(): bool
    {
        return !is_null($this->rejection_reason);
    }

    public function isValidated(): bool
    {
        return !is_null($this->validated_at);
    }
}

