<?php

declare(strict_types=1);

namespace College\Courses;

class CoursesDto 
{
    public int $courseId;
    public string $courseName;
    public int $textbookIsbn;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->courseId = (int) ($row["course_id"] ?? 0);
        $this->courseName = $row["course_name"] ?? "";
        $this->textbookIsbn = (int) ($row["textbook_isbn"] ?? 0);
    }
}