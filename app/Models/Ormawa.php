<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[Fillable(['nama', 'kategori', 'fakultas', 'periode', 'logo'])]
#[Appends('admin_password')]
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

    public function getAdminPasswordAttribute(): string
    {
        $user = $this->users()->first();
        if (!$user) return '-';
        return $user->username . '@unsera26';
    }
}
