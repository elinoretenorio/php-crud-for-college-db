<?php

declare(strict_types=1);

namespace College\Buildings;

class BuildingsService implements IBuildingsService
{
    private IBuildingsRepository $repository;

    public function __construct(IBuildingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(BuildingsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(BuildingsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $buildingId): ?BuildingsModel
    {
        $dto = $this->repository->get($buildingId);
        if ($dto === null) {
            return null;
        }

        return new BuildingsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var BuildingsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new BuildingsModel($dto);
        }

        return $result;
    }

    public function delete(int $buildingId): int
    {
        return $this->repository->delete($buildingId);
    }

    public function createModel(array $row): ?BuildingsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new BuildingsDto($row);

        return new BuildingsModel($dto);
    }
}