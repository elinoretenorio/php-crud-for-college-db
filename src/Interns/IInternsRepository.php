<?php

declare(strict_types=1);

namespace College\Interns;

interface IInternsRepository
{
    public function insert(InternsDto $dto): int;

    public function update(InternsDto $dto): int;

    public function get(int $internId): ?InternsDto;

    public function getAll(): array;

    public function delete(int $internId): int;
}