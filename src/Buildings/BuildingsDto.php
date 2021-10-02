<?php

declare(strict_types=1);

namespace College\Buildings;

class BuildingsDto 
{
    public int $buildingId;
    public string $buildingName;
    public string $collegeName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->buildingId = (int) ($row["building_id"] ?? 0);
        $this->buildingName = $row["building_name"] ?? "";
        $this->collegeName = $row["college_name"] ?? "";
    }
}