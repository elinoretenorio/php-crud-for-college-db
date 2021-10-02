<?php

declare(strict_types=1);

namespace College\Sections;

class SectionsService implements ISectionsService
{
    private ISectionsRepository $repository;

    public function __construct(ISectionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(SectionsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(SectionsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $sectionId): ?SectionsModel
    {
        $dto = $this->repository->get($sectionId);
        if ($dto === null) {
            return null;
        }

        return new SectionsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var SectionsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new SectionsModel($dto);
        }

        return $result;
    }

    public function delete(int $sectionId): int
    {
        return $this->repository->delete($sectionId);
    }

    public function createModel(array $row): ?SectionsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new SectionsDto($row);

        return new SectionsModel($dto);
    }
}