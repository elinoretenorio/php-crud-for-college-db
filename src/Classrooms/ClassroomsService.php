<?php

declare(strict_types=1);

namespace College\Classrooms;

class ClassroomsService implements IClassroomsService
{
    private IClassroomsRepository $repository;

    public function __construct(IClassroomsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ClassroomsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ClassroomsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $classroomId): ?ClassroomsModel
    {
        $dto = $this->repository->get($classroomId);
        if ($dto === null) {
            return null;
        }

        return new ClassroomsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ClassroomsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ClassroomsModel($dto);
        }

        return $result;
    }

    public function delete(int $classroomId): int
    {
        return $this->repository->delete($classroomId);
    }

    public function createModel(array $row): ?ClassroomsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ClassroomsDto($row);

        return new ClassroomsModel($dto);
    }
}