<?php

namespace App\Application\Justifications;

use App\Domain\Justifications\Contracts\JustificationRepository;

class AdminDecideJustification
{
    public function __construct(private JustificationRepository $repo) {}

    public function accept(int $id, string $respuesta): bool
    {
        return $this->repo->updateStatus($id, 'aceptado', ['respuesta_admin' => $respuesta]);
    }

    public function reject(int $id, string $respuesta): bool
    {
        return $this->repo->updateStatus($id, 'rechazado', ['respuesta_admin' => $respuesta]);
    }
}
