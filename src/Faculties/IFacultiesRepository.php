<?php

declare(strict_types=1);

namespace College\Faculties;

interface IFacultiesRepository
{
    public function insert(FacultiesDto $dto): int;

    public function update(FacultiesDto $dto): int;

    public function get(int $facultyId): ?FacultiesDto;

    public function getAll(): array;

    public function delete(int $facultyId): int;
}