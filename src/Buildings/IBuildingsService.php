<?php

declare(strict_types=1);

namespace College\Buildings;

interface IBuildingsService
{
    public function insert(BuildingsModel $model): int;

    public function update(BuildingsModel $model): int;

    public function get(int $buildingId): ?BuildingsModel;

    public function getAll(): array;

    public function delete(int $buildingId): int;

    public function createModel(array $row): ?BuildingsModel;
}