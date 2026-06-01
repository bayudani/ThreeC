<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['proker_id', 'file_path', 'keterangan'])]
class Dokumentasi extends Model
{
    public function proker(): BelongsTo {
        return $this->belongsTo(Proker::class);
    }
}

