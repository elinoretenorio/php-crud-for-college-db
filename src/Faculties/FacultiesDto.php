<?php

declare(strict_types=1);

namespace College\Faculties;

class FacultiesDto 
{
    public int $facultyId;
    public float $facultySalary;
    public string $facultyName;
    public int $personId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->facultyId = (int) ($row["faculty_id"] ?? 0);
        $this->facultySalary = (float) ($row["faculty_salary"] ?? 0);
        $this->facultyName = $row["faculty_name"] ?? "";
        $this->personId = (int) ($row["person_id"] ?? 0);
    }
}