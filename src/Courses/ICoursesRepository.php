<?php

declare(strict_types=1);

namespace College\Courses;

interface ICoursesRepository
{
    public function insert(CoursesDto $dto): int;

    public function update(CoursesDto $dto): int;

    public function get(int $courseId): ?CoursesDto;

    public function getAll(): array;

    public function delete(int $courseId): int;
}