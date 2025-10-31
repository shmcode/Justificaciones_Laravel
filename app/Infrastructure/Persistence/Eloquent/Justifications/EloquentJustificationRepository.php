<?php

namespace App\Infrastructure\Persistence\Eloquent\Justifications;

use App\Domain\Justifications\Contracts\JustificationRepository;
use App\Models\Justification;
use Illuminate\Support\Collection;

class EloquentJustificationRepository implements JustificationRepository
{
    public function findById(int $id): ?Justification
    {
        return Justification::find($id);
    }

    public function getAll(array $filters = []): Collection
    {
        return $this->applyFilters(
            Justification::with(['student', 'classroom', 'professor']),
            $filters
        )->get();
    }

    public function forStudent(int $studentId, array $filters = []): Collection
    {
        return $this->applyFilters(
            Justification::with('classroom','professor')->where('student_id', $studentId),
            $filters
        )->get();
    }

    public function forProfessor(int $professorId, array $filters = []): Collection
    {
        return $this->applyFilters(
            Justification::with('student','classroom')->where('professor_id', $professorId),
            $filters
        )->get();
    }

    public function forClassroom(int $classroomId, array $filters = []): Collection
    {
        return $this->applyFilters(
            Justification::with('student','classroom')->where('classroom_id', $classroomId),
            $filters
        )->get();
    }

    public function create(array $data): Justification
    {
        return Justification::create($data);
    }

    public function updateStatus(int $id, string $status, array $extra = []): bool
    {
        $j = Justification::findOrFail($id);
        $j->status = $status;

        if (array_key_exists('respuesta_admin', $extra)) {
            $j->respuesta_admin = $extra['respuesta_admin'];
        }

        if (array_key_exists('comentario', $extra)) {
            $j->comentario = $extra['comentario'];
        }

        return $j->save();
    }

    private function applyFilters($query, array $filters)
    {
        if (!empty($filters['status']))        $query->where('status', $filters['status']);
        if (!empty($filters['classroom_id']))  $query->where('classroom_id', $filters['classroom_id']);
        if (!empty($filters['updated_since'])) $query->where('updated_at', '>=', $filters['updated_since']);
        return $query;
    }
}
