<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[Fillable(['nama', 'kategori', 'fakultas', 'periode', 'logo'])]
class Ormawa extends Model
{
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function prokers(): HasMany {
        return $this->hasMany(Proker::class);
    }

    public function logoUrl(): string
    {
        return $this->logo ? Storage::url($this->logo) : '';
    }
}
