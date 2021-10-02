<?php

declare(strict_types=1);

namespace College\Colleges;

class CollegesService implements ICollegesService
{
    private ICollegesRepository $repository;

    public function __construct(ICollegesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CollegesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CollegesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $collegeId): ?CollegesModel
    {
        $dto = $this->repository->get($collegeId);
        if ($dto === null) {
            return null;
        }

        return new CollegesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CollegesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CollegesModel($dto);
        }

        return $result;
    }

    public function delete(int $collegeId): int
    {
        return $this->repository->delete($collegeId);
    }

    public function createModel(array $row): ?CollegesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CollegesDto($row);

        return new CollegesModel($dto);
    }
}