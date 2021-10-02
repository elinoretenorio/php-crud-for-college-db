<?php

declare(strict_types=1);

namespace College\Persons;

interface IPersonsService
{
    public function insert(PersonsModel $model): int;

    public function update(PersonsModel $model): int;

    public function get(int $personId): ?PersonsModel;

    public function getAll(): array;

    public function delete(int $personId): int;

    public function createModel(array $row): ?PersonsModel;
}