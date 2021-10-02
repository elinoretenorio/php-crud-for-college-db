<?php

declare(strict_types=1);

namespace College\Textbooks;

class TextbooksService implements ITextbooksService
{
    private ITextbooksRepository $repository;

    public function __construct(ITextbooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(TextbooksModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(TextbooksModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $textbookId): ?TextbooksModel
    {
        $dto = $this->repository->get($textbookId);
        if ($dto === null) {
            return null;
        }

        return new TextbooksModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var TextbooksDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new TextbooksModel($dto);
        }

        return $result;
    }

    public function delete(int $textbookId): int
    {
        return $this->repository->delete($textbookId);
    }

    public function createModel(array $row): ?TextbooksModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new TextbooksDto($row);

        return new TextbooksModel($dto);
    }
}