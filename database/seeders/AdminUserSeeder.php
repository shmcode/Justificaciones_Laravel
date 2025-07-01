<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@uamv.edu.ni',
            'password' => bcrypt('Nicaragua25$'),
            'role' => 'admin',
        ]);
    }
}