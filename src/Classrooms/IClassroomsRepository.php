<?php

declare(strict_types=1);

namespace College\Classrooms;

interface IClassroomsRepository
{
    public function insert(ClassroomsDto $dto): int;

    public function update(ClassroomsDto $dto): int;

    public function get(int $classroomId): ?ClassroomsDto;

    public function getAll(): array;

    public function delete(int $classroomId): int;
}