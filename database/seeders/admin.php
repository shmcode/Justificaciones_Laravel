<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Administrador',
        'email' => 'admin@admin.com',
        'password' => Hash::make('12345678'), 
        'role' => 'admin',
    ]);
    }
}