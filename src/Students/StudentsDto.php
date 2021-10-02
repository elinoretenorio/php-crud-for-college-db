<?php

declare(strict_types=1);

namespace College\Students;

class StudentsDto 
{
    public int $studentId;
    public float $studentGpa;
    public string $studentName;
    public int $personId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->studentId = (int) ($row["student_id"] ?? 0);
        $this->studentGpa = (float) ($row["student_gpa"] ?? 0);
        $this->studentName = $row["student_name"] ?? "";
        $this->personId = (int) ($row["person_id"] ?? 0);
    }
}