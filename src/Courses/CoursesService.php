<?php

declare(strict_types=1);

namespace College\Courses;

class CoursesService implements ICoursesService
{
    private ICoursesRepository $repository;

    public function __construct(ICoursesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CoursesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CoursesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $courseId): ?CoursesModel
    {
        $dto = $this->repository->get($courseId);
        if ($dto === null) {
            return null;
        }

        return new CoursesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CoursesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CoursesModel($dto);
        }

        return $result;
    }

    public function delete(int $courseId): int
    {
        return $this->repository->delete($courseId);
    }

    public function createModel(array $row): ?CoursesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CoursesDto($row);

        return new CoursesModel($dto);
    }
}