<?php

declare(strict_types=1);

namespace College\Faculties;

class FacultiesService implements IFacultiesService
{
    private IFacultiesRepository $repository;

    public function __construct(IFacultiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(FacultiesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(FacultiesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $facultyId): ?FacultiesModel
    {
        $dto = $this->repository->get($facultyId);
        if ($dto === null) {
            return null;
        }

        return new FacultiesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var FacultiesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new FacultiesModel($dto);
        }

        return $result;
    }

    public function delete(int $facultyId): int
    {
        return $this->repository->delete($facultyId);
    }

    public function createModel(array $row): ?FacultiesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new FacultiesDto($row);

        return new FacultiesModel($dto);
    }
}