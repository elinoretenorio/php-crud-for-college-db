<?php

declare(strict_types=1);

namespace College\Interns;

use JsonSerializable;

class InternsModel implements JsonSerializable
{
    private int $internId;
    private int $personId;
    private float $internHourlyWage;

    public function __construct(InternsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->internId = $dto->internId;
        $this->personId = $dto->personId;
        $this->internHourlyWage = $dto->internHourlyWage;
    }

    public function getInternId(): int
    {
        return $this->internId;
    }

    public function setInternId(int $internId): void
    {
        $this->internId = $internId;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function getInternHourlyWage(): float
    {
        return $this->internHourlyWage;
    }

    public function setInternHourlyWage(float $internHourlyWage): void
    {
        $this->internHourlyWage = $internHourlyWage;
    }

    public function toDto(): InternsDto
    {
        $dto = new InternsDto();
        $dto->internId = (int) ($this->internId ?? 0);
        $dto->personId = (int) ($this->personId ?? 0);
        $dto->internHourlyWage = (float) ($this->internHourlyWage ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "intern_id" => $this->internId,
            "person_id" => $this->personId,
            "intern_hourly_wage" => $this->internHourlyWage,
        ];
    }
}