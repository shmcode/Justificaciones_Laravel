<?php

namespace App\Domain\Justifications\Composite;

class JustificationGroupComposite implements JustificationComponent
{
    /** @param JustificationComponent[] $children */
    public function __construct(
        private int|string $id,
        private string $name,
        private array $children = []
    ) {}

    public function getId(): int|string { return $this->id; }
    public function getName(): string { return $this->name; }

    public function add(JustificationComponent $child): void { $this->children[] = $child; }
    public function list(): array { return $this->children; }

    public function getStatus(): array
    {
        $agg = ['pendiente'=>0,'aceptado'=>0,'rechazado'=>0,'apelado'=>0];
        foreach ($this->children as $c) {
            $st = $c->getStatus();
            foreach ($agg as $k => $_) { $agg[$k] += $st[$k] ?? 0; }
        }
        return $agg;
    }

    public function approve(int $adminId): int
    {
        $count = 0;
        foreach ($this->children as $c) { $count += $c->approve($adminId); }
        return $count;
    }

    public function reject(int $adminId, string $reason): int
    {
        $count = 0;
        foreach ($this->children as $c) { $count += $c->reject($adminId, $reason); }
        return $count;
    }
}
