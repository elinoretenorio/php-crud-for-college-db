<?php

declare(strict_types=1);

namespace College\Interns;

class InternsService implements IInternsService
{
    private IInternsRepository $repository;

    public function __construct(IInternsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(InternsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(InternsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $internId): ?InternsModel
    {
        $dto = $this->repository->get($internId);
        if ($dto === null) {
            return null;
        }

        return new InternsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var InternsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new InternsModel($dto);
        }

        return $result;
    }

    public function delete(int $internId): int
    {
        return $this->repository->delete($internId);
    }

    public function createModel(array $row): ?InternsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new InternsDto($row);

        return new InternsModel($dto);
    }
}