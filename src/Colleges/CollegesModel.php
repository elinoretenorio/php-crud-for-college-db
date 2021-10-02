<?php

declare(strict_types=1);

namespace College\Colleges;

use JsonSerializable;

class CollegesModel implements JsonSerializable
{
    private int $collegeId;
    private string $collegeName;
    private int $collegeTotalStudents;

    public function __construct(CollegesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->collegeId = $dto->collegeId;
        $this->collegeName = $dto->collegeName;
        $this->collegeTotalStudents = $dto->collegeTotalStudents;
    }

    public function getCollegeId(): int
    {
        return $this->collegeId;
    }

    public function setCollegeId(int $collegeId): void
    {
        $this->collegeId = $collegeId;
    }

    public function getCollegeName(): string
    {
        return $this->collegeName;
    }

    public function setCollegeName(string $collegeName): void
    {
        $this->collegeName = $collegeName;
    }

    public function getCollegeTotalStudents(): int
    {
        return $this->collegeTotalStudents;
    }

    public function setCollegeTotalStudents(int $collegeTotalStudents): void
    {
        $this->collegeTotalStudents = $collegeTotalStudents;
    }

    public function toDto(): CollegesDto
    {
        $dto = new CollegesDto();
        $dto->collegeId = (int) ($this->collegeId ?? 0);
        $dto->collegeName = $this->collegeName ?? "";
        $dto->collegeTotalStudents = (int) ($this->collegeTotalStudents ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "college_id" => $this->collegeId,
            "college_name" => $this->collegeName,
            "college_total_students" => $this->collegeTotalStudents,
        ];
    }
}