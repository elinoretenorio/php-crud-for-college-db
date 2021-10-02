<?php

declare(strict_types=1);

namespace College\Faculties;

interface IFacultiesService
{
    public function insert(FacultiesModel $model): int;

    public function update(FacultiesModel $model): int;

    public function get(int $facultyId): ?FacultiesModel;

    public function getAll(): array;

    public function delete(int $facultyId): int;

    public function createModel(array $row): ?FacultiesModel;
}