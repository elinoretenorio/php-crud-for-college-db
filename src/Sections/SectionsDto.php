<?php

declare(strict_types=1);

namespace College\Sections;

class SectionsDto 
{
    public int $sectionId;
    public string $sectionDate;
    public int $roomNumber;
    public int $courseId;
    public int $buildingId;
    public int $personId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->sectionId = (int) ($row["section_id"] ?? 0);
        $this->sectionDate = $row["section_date"] ?? "";
        $this->roomNumber = (int) ($row["room_number"] ?? 0);
        $this->courseId = (int) ($row["course_id"] ?? 0);
        $this->buildingId = (int) ($row["building_id"] ?? 0);
        $this->personId = (int) ($row["person_id"] ?? 0);
    }
}