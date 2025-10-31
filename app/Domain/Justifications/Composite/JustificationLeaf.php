<?php

namespace App\Domain\Justifications\Composite;

use App\Models\Justification;

class JustificationLeaf implements JustificationComponent
{
    public function __construct(private Justification $model) {}

    public function getId(): int|string { return $this->model->id; }

    public function getStatus(): array
    {
        $all = ['pendiente'=>0,'aceptado'=>0,'rechazado'=>0,'apelado'=>0];
        $state = $this->model->status;
        if (isset($all[$state])) $all[$state] = 1;
        return $all;
    }

    public function list(): array { return []; }

    public function approve(int $adminId): int
    {
        if ($this->model->status === 'pendiente' || $this->model->status === 'apelado') {
            $this->model->status = 'aceptado';
            $this->model->save();
            // Opcional: AuditLog::record($adminId, 'approve', $this->model->id);
            return 1;
        }
        return 0;
    }

    public function reject(int $adminId, string $reason): int
    {
        if ($this->model->status === 'pendiente' || $this->model->status === 'apelado') {
            $this->model->status = 'rechazado';
            $this->model->respuesta_admin = $reason;
            $this->model->save();
            // Opcional: AuditLog::record($adminId, 'reject', $this->model->id, $reason);
            return 1;
        }
        return 0;
    }
}
