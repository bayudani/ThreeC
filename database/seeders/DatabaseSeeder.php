<?php

namespace Database\Seeders;

use App\Models\Ormawa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            OrmawaSeeder::class,
            ProkerSeeder::class,
        ]);

        User::create([
            'name' => 'Admin Kemahasiswaan',
            'username' => 'adminkampus',
            'email' => 'admin@unsera.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin_kampus',
            'ormawa_id' => null,
        ]);

        $ormawas = Ormawa::all();
        foreach ($ormawas as $ormawa) {
            $username = strtolower(str_replace(' ', '', $ormawa->nama));
            User::create([
                'name' => "Admin {$ormawa->nama}",
                'username' => $username,
                'email' => "{$username}@unsera.ac.id",
                'password' => Hash::make('password123'),
                'role' => 'admin_ormawa',
                'ormawa_id' => $ormawa->id,
            ]);
        }
    }
}
