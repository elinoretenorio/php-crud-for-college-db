<?php

declare(strict_types=1);

namespace College\Courses;

interface ICoursesService
{
    public function insert(CoursesModel $model): int;

    public function update(CoursesModel $model): int;

    public function get(int $courseId): ?CoursesModel;

    public function getAll(): array;

    public function delete(int $courseId): int;

    public function createModel(array $row): ?CoursesModel;
}