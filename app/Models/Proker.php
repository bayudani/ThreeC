<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['ormawa_id', 'nama_proker', 'deskripsi', 'target_waktu', 'status', 'progress'])]
class Proker extends Model
{
    public function ormawa(): BelongsTo {
        return $this->belongsTo(Ormawa::class);
    }

    public function dokumentasis(): HasMany {
        return $this->hasMany(Dokumentasi::class);
    }
}

