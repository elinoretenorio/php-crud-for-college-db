<?php

declare(strict_types=1);

namespace College\Colleges;

interface ICollegesService
{
    public function insert(CollegesModel $model): int;

    public function update(CollegesModel $model): int;

    public function get(int $collegeId): ?CollegesModel;

    public function getAll(): array;

    public function delete(int $collegeId): int;

    public function createModel(array $row): ?CollegesModel;
}