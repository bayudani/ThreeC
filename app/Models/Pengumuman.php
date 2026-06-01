<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['judul', 'isi', 'tipe', 'is_active'])]

class Pengumuman extends Model
{
    protected $table = 'pengumumans';
}
