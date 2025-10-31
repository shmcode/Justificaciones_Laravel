<?php

namespace App\Domain\Justifications\Composite;

use App\Models\Justification;

class JustificationTreeBuilder
{
    /**
     * Crea un árbol: Clase > Estado (Pendiente/Aceptado/Rechazado/Apelado) > Hojas
     */
    public static function byClassAndState(int $classroomId): JustificationGroupComposite
    {
        $root = new JustificationGroupComposite("class:$classroomId", "Clase $classroomId");

        $groups = [
            'pendiente' => new JustificationGroupComposite("c:$classroomId:pend",  "Pendientes"),
            'aceptado'  => new JustificationGroupComposite("c:$classroomId:acep",  "Aceptadas"),
            'rechazado' => new JustificationGroupComposite("c:$classroomId:rech",  "Rechazadas"),
            'apelado'   => new JustificationGroupComposite("c:$classroomId:apel",  "Apeladas"),
        ];

        $rows = Justification::where('classroom_id', $classroomId)->get();
        foreach ($rows as $row) {
            $leaf = new JustificationLeaf($row);
            $state = $row->status;
            $key = isset($groups[$state]) ? $state : 'pendiente';
            $groups[$key]->add($leaf);
        }

        foreach ($groups as $g) { $root->add($g); }
        return $root;
    }

    /**
     * Variante: Clase > Estudiante > Hojas (útil para profesor)
     */
    public static function byClassAndStudent(int $classroomId): JustificationGroupComposite
    {
        $root = new JustificationGroupComposite("class:$classroomId", "Clase $classroomId");

        $byStudent = Justification::where('classroom_id', $classroomId)->get()->groupBy('student_id');
        foreach ($byStudent as $studentId => $items) {
            $studentGroup = new JustificationGroupComposite("c:$classroomId:s:$studentId", "Estudiante $studentId");
            foreach ($items as $row) {
                $studentGroup->add(new JustificationLeaf($row));
            }
            $root->add($studentGroup);
        }
        return $root;
    }

    /**
     * Construye un composite con un subconjunto arbitrario (ej. filtros del Admin)
     */
    public static function fromCollection(string $id, string $name, \Illuminate\Support\Collection $rows): JustificationGroupComposite
    {
        $root = new JustificationGroupComposite($id, $name);
        foreach ($rows as $row) { $root->add(new JustificationLeaf($row)); }
        return $root;
    }
}
