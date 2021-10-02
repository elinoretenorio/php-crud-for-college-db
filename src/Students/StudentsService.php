<?php

declare(strict_types=1);

namespace College\Students;

class StudentsService implements IStudentsService
{
    private IStudentsRepository $repository;

    public function __construct(IStudentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(StudentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(StudentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $studentId): ?StudentsModel
    {
        $dto = $this->repository->get($studentId);
        if ($dto === null) {
            return null;
        }

        return new StudentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var StudentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new StudentsModel($dto);
        }

        return $result;
    }

    public function delete(int $studentId): int
    {
        return $this->repository->delete($studentId);
    }

    public function createModel(array $row): ?StudentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new StudentsDto($row);

        return new StudentsModel($dto);
    }
}