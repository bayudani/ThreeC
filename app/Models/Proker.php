<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['ormawa_id', 'nama_proker', 'deskripsi', 'target_waktu', 'status', 'progress', 'validated_at', 'rejection_reason'])]
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

