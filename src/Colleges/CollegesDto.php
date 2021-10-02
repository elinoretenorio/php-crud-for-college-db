<?php

declare(strict_types=1);

namespace College\Colleges;

class CollegesDto 
{
    public int $collegeId;
    public string $collegeName;
    public int $collegeTotalStudents;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->collegeId = (int) ($row["college_id"] ?? 0);
        $this->collegeName = $row["college_name"] ?? "";
        $this->collegeTotalStudents = (int) ($row["college_total_students"] ?? 0);
    }
}