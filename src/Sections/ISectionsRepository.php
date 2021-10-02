<?php

declare(strict_types=1);

namespace College\Sections;

interface ISectionsRepository
{
    public function insert(SectionsDto $dto): int;

    public function update(SectionsDto $dto): int;

    public function get(int $sectionId): ?SectionsDto;

    public function getAll(): array;

    public function delete(int $sectionId): int;
}