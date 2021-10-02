<?php

declare(strict_types=1);

namespace College\Textbooks;

interface ITextbooksRepository
{
    public function insert(TextbooksDto $dto): int;

    public function update(TextbooksDto $dto): int;

    public function get(int $textbookId): ?TextbooksDto;

    public function getAll(): array;

    public function delete(int $textbookId): int;
}