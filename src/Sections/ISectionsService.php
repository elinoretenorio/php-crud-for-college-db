<?php

declare(strict_types=1);

namespace College\Sections;

interface ISectionsService
{
    public function insert(SectionsModel $model): int;

    public function update(SectionsModel $model): int;

    public function get(int $sectionId): ?SectionsModel;

    public function getAll(): array;

    public function delete(int $sectionId): int;

    public function createModel(array $row): ?SectionsModel;
}