<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Facultad;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $facultades = ['Facultad de Ciencias Administrativas y Económicas',
         'Facultad de Ciencias Jurídicas, Humanidades y Relaciones Internacionales',
         'Facultad de Ciencias Médicas',
         'Facultad de Ingeniería y Arquitectura',
         'Facultad de Marketing, Diseño y Ciencias de la Comunicación',
         'Facultad de Odontología',
         'UAM College',];

        foreach ($facultades as $nombre) {
            Facultad::create(['name' => $nombre]);
        }
    }
}