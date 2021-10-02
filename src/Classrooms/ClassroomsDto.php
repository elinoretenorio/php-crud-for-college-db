<?php

declare(strict_types=1);

namespace College\Classrooms;

class ClassroomsDto 
{
    public int $classroomId;
    public int $roomNumber;
    public bool $hasProjector;
    public int $buildingId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->classroomId = (int) ($row["classroom_id"] ?? 0);
        $this->roomNumber = (int) ($row["room_number"] ?? 0);
        $this->hasProjector = (bool) $row["has_projector"];
        $this->buildingId = (int) ($row["building_id"] ?? 0);
    }
}