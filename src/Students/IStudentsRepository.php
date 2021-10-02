<?php

declare(strict_types=1);

namespace College\Students;

interface IStudentsRepository
{
    public function insert(StudentsDto $dto): int;

    public function update(StudentsDto $dto): int;

    public function get(int $studentId): ?StudentsDto;

    public function getAll(): array;

    public function delete(int $studentId): int;
}