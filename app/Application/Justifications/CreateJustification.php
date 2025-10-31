<?php

namespace App\Application\Justifications;

use App\Domain\Justifications\Contracts\JustificationRepository;

class CreateJustification
{
    public function __construct(private JustificationRepository $repo) {}

    public function __invoke(array $data): \App\Models\Justification
    {
        // Aquí podrías validar reglas de negocio adicionales
        return $this->repo->create($data);
    }
}
