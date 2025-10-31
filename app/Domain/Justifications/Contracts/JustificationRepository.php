<?php

namespace App\Domain\Justifications\Contracts;

use Illuminate\Support\Collection;

interface JustificationRepository
{
    public function findById(int $id): ?\App\Models\Justification;

    /** Lista general de justificaciones con filtros (para Admin) */
    public function getAll(array $filters = []): Collection;

    /** Justificaciones del estudiante autenticado (o dado) con filtros */
    public function forStudent(int $studentId, array $filters = []): Collection;

    /** Justificaciones de un profesor (sus clases), con filtros */
    public function forProfessor(int $professorId, array $filters = []): Collection;

    /** Justificaciones por clase (para resúmenes/composite) */
    public function forClassroom(int $classroomId, array $filters = []): Collection;

    public function create(array $data): \App\Models\Justification;

    public function updateStatus(int $id, string $status, array $extra = []): bool;
}
