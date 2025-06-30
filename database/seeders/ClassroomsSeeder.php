<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facultad;
use App\Models\User;
use App\Models\Classroom;

class ClassroomsSeeder extends Seeder
{
    public function run(): void
    {
        $clasesPorFacultad = [
            'Facultad de Ciencias Administrativas y Económicas' => [
                'Contabilidad I',
                'Introducción a la Economía'
            ],
            'Facultad de Ciencias Jurídicas, Humanidades y Relaciones Internacionales' => [
                'Derecho Constitucional',
                'Sociología Jurídica'
            ],
            'Facultad de Ciencias Médicas' => [
                'Anatomía Humana',
                'Fisiología General'
            ],
            'Facultad de Ingeniería y Arquitectura' => [
                'Diseño Web y Comercio Electrónico',
                'Tecnología de Redes I'
            ],
            'Facultad de Marketing, Diseño y Ciencias de la Comunicación' => [
                'Comunicación y Lenguaje I',
                'Fundamentos del Diseño'
            ],
            'Facultad de Odontología' => [
                'Introducción a la Odontología',
                'Biología I'
            ],
            'UAM College' => [
                'English Composition I',
                'Introduction to Business'
            ],
        ];

        $profesorPredeterminado = User::where('role', 'profesor')->first()?->id ?? 1;

        foreach ($clasesPorFacultad as $nombreFacultad => $clases) {
            $facultad = Facultad::firstOrCreate(['name' => $nombreFacultad]);

            $profesor = User::where('facultad_id', $facultad->id)
                            ->where('role', 'profesor')
                            ->first();

            $professorId = $profesor?->id ?? $profesorPredeterminado;

            foreach ($clases as $nombreClase) {
                $classroom = new Classroom();
                $classroom->name = $nombreClase;
                $classroom->facultad_id = $facultad->id;
                $classroom->professor_id = $professorId;
                $classroom->save();
            }
        }
    }
}