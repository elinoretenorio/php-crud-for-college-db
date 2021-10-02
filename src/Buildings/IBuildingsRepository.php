<?php

declare(strict_types=1);

namespace College\Buildings;

interface IBuildingsRepository
{
    public function insert(BuildingsDto $dto): int;

    public function update(BuildingsDto $dto): int;

    public function get(int $buildingId): ?BuildingsDto;

    public function getAll(): array;

    public function delete(int $buildingId): int;
}