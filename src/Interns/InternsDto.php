<?php

declare(strict_types=1);

namespace College\Interns;

class InternsDto 
{
    public int $internId;
    public int $personId;
    public float $internHourlyWage;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->internId = (int) ($row["intern_id"] ?? 0);
        $this->personId = (int) ($row["person_id"] ?? 0);
        $this->internHourlyWage = (float) ($row["intern_hourly_wage"] ?? 0);
    }
}