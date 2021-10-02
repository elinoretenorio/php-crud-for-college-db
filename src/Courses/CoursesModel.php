<?php

declare(strict_types=1);

namespace College\Courses;

use JsonSerializable;

class CoursesModel implements JsonSerializable
{
    private int $courseId;
    private string $courseName;
    private int $textbookIsbn;

    public function __construct(CoursesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->courseId = $dto->courseId;
        $this->courseName = $dto->courseName;
        $this->textbookIsbn = $dto->textbookIsbn;
    }

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function setCourseId(int $courseId): void
    {
        $this->courseId = $courseId;
    }

    public function getCourseName(): string
    {
        return $this->courseName;
    }

    public function setCourseName(string $courseName): void
    {
        $this->courseName = $courseName;
    }

    public function getTextbookIsbn(): int
    {
        return $this->textbookIsbn;
    }

    public function setTextbookIsbn(int $textbookIsbn): void
    {
        $this->textbookIsbn = $textbookIsbn;
    }

    public function toDto(): CoursesDto
    {
        $dto = new CoursesDto();
        $dto->courseId = (int) ($this->courseId ?? 0);
        $dto->courseName = $this->courseName ?? "";
        $dto->textbookIsbn = (int) ($this->textbookIsbn ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "course_id" => $this->courseId,
            "course_name" => $this->courseName,
            "textbook_isbn" => $this->textbookIsbn,
        ];
    }
}