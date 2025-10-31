<?php

namespace App\Application\Justifications;

use App\Domain\Justifications\Contracts\JustificationRepository;

class AppealJustification
{
    public function __construct(private JustificationRepository $repo) {}

    public function __invoke(int $studentId, int $justificationId, array $payload): bool
    {
        // Aquí podrías verificar ownership, ventana de 7 días, etc.
        return $this->repo->updateStatus($justificationId, 'apelado', [
            'comentario' => $payload['motivo_apelacion'] ?? '',
        ]);
    }
}
