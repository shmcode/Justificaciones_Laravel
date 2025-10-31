<?php

namespace App\Domain\Justifications\Composite;

interface JustificationComponent
{
    public function getId(): string|int;

    /** Conteo agregado por estado */
    public function getStatus(): array; 
    // ['pendiente'=>n,'aceptado'=>n,'rechazado'=>n,'apelado'=>n]

    /** Hijos (para hoja será []) */
    public function list(): array;

    /** Acciones (para profesor no se expondrán) */
    public function approve(int $adminId): int; // devuelve cuántas aprobó
    public function reject(int $adminId, string $reason): int; // cuántas rechazó
}
