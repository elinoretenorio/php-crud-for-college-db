<?php

declare(strict_types=1);

namespace College\Persons;

interface IPersonsRepository
{
    public function insert(PersonsDto $dto): int;

    public function update(PersonsDto $dto): int;

    public function get(int $personId): ?PersonsDto;

    public function getAll(): array;

    public function delete(int $personId): int;
}