<?php

declare(strict_types=1);

namespace College\Colleges;

interface ICollegesRepository
{
    public function insert(CollegesDto $dto): int;

    public function update(CollegesDto $dto): int;

    public function get(int $collegeId): ?CollegesDto;

    public function getAll(): array;

    public function delete(int $collegeId): int;
}