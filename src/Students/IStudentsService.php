<?php

declare(strict_types=1);

namespace College\Students;

interface IStudentsService
{
    public function insert(StudentsModel $model): int;

    public function update(StudentsModel $model): int;

    public function get(int $studentId): ?StudentsModel;

    public function getAll(): array;

    public function delete(int $studentId): int;

    public function createModel(array $row): ?StudentsModel;
}