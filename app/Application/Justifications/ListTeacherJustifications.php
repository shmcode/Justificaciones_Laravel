<?php

namespace App\Application\Justifications;

use App\Domain\Justifications\Contracts\JustificationRepository;

class ListTeacherJustifications
{
    public function __construct(private JustificationRepository $repo) {}

    public function __invoke(int $professorId, array $filters = [])
    {
        return $this->repo->forProfessor($professorId, $filters);
    }
}
