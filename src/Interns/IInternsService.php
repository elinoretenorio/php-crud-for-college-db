<?php

declare(strict_types=1);

namespace College\Interns;

interface IInternsService
{
    public function insert(InternsModel $model): int;

    public function update(InternsModel $model): int;

    public function get(int $internId): ?InternsModel;

    public function getAll(): array;

    public function delete(int $internId): int;

    public function createModel(array $row): ?InternsModel;
}