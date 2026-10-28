<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama', 'kode', 'is_active'])]
class Fakultas extends Model
{
    use HasFactory;

    public function ormawas()
    {
        return $this->hasMany(Ormawa::class);
    }
}
