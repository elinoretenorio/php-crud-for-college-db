<?php

declare(strict_types=1);

namespace College\Faculties;

use JsonSerializable;

class FacultiesModel implements JsonSerializable
{
    private int $facultyId;
    private float $facultySalary;
    private string $facultyName;
    private int $personId;

    public function __construct(FacultiesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->facultyId = $dto->facultyId;
        $this->facultySalary = $dto->facultySalary;
        $this->facultyName = $dto->facultyName;
        $this->personId = $dto->personId;
    }

    public function getFacultyId(): int
    {
        return $this->facultyId;
    }

    public function setFacultyId(int $facultyId): void
    {
        $this->facultyId = $facultyId;
    }

    public function getFacultySalary(): float
    {
        return $this->facultySalary;
    }

    public function setFacultySalary(float $facultySalary): void
    {
        $this->facultySalary = $facultySalary;
    }

    public function getFacultyName(): string
    {
        return $this->facultyName;
    }

    public function setFacultyName(string $facultyName): void
    {
        $this->facultyName = $facultyName;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function toDto(): FacultiesDto
    {
        $dto = new FacultiesDto();
        $dto->facultyId = (int) ($this->facultyId ?? 0);
        $dto->facultySalary = (float) ($this->facultySalary ?? 0);
        $dto->facultyName = $this->facultyName ?? "";
        $dto->personId = (int) ($this->personId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "faculty_id" => $this->facultyId,
            "faculty_salary" => $this->facultySalary,
            "faculty_name" => $this->facultyName,
            "person_id" => $this->personId,
        ];
    }
}