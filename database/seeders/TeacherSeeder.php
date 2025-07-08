<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Facultad;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $facultades = Facultad::all();

        $profesores = [
            ['name' => 'Juan Pérez', 'email' => 'juan.perez@uamv.edu.ni'],
            ['name' => 'María Gómez', 'email' => 'maria.gomez@uamv.edu.ni'],
            ['name' => 'Carlos Rodríguez', 'email' => 'carlos.rodriguez@uamv.edu.ni'],
            ['name' => 'Ana Martínez', 'email' => 'ana.martinez@uamv.edu.ni'],
            ['name' => 'Luis Fernández', 'email' => 'luis.fernandez@uamv.edu.ni'],
            ['name' => 'Laura Torres', 'email' => 'laura.torres@uamv.edu.ni'],
            ['name' => 'Pedro Sánchez', 'email' => 'pedro.sanchez@uamv.edu.ni'],
        ];

        foreach ($profesores as $index => $profesor) {
            User::create([
                'name'        => $profesor['name'],
                'email'       => $profesor['email'],
                'password'    => Hash::make('Nicaragua25$'),
                'role'        => 'teacher',
                'facultad_id' => $facultades[$index % $facultades->count()]->id,
            ]);
        }
    }
}
