<?php

declare(strict_types=1);

namespace College\Textbooks;

interface ITextbooksService
{
    public function insert(TextbooksModel $model): int;

    public function update(TextbooksModel $model): int;

    public function get(int $textbookId): ?TextbooksModel;

    public function getAll(): array;

    public function delete(int $textbookId): int;

    public function createModel(array $row): ?TextbooksModel;
}