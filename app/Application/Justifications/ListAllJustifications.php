<?php

namespace App\Application\Justifications;

use App\Domain\Justifications\Contracts\JustificationRepository;

class ListAllJustifications
{
    public function __construct(private JustificationRepository $repo) {}

    public function __invoke(array $filters = [])
    {
        return $this->repo->getAll($filters);
    }
}
