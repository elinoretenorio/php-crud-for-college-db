<?php

declare(strict_types=1);

namespace College\Classrooms;

interface IClassroomsService
{
    public function insert(ClassroomsModel $model): int;

    public function update(ClassroomsModel $model): int;

    public function get(int $classroomId): ?ClassroomsModel;

    public function getAll(): array;

    public function delete(int $classroomId): int;

    public function createModel(array $row): ?ClassroomsModel;
}