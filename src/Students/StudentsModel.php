<?php

declare(strict_types=1);

namespace College\Students;

use JsonSerializable;

class StudentsModel implements JsonSerializable
{
    private int $studentId;
    private float $studentGpa;
    private string $studentName;
    private int $personId;

    public function __construct(StudentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->studentId = $dto->studentId;
        $this->studentGpa = $dto->studentGpa;
        $this->studentName = $dto->studentName;
        $this->personId = $dto->personId;
    }

    public function getStudentId(): int
    {
        return $this->studentId;
    }

    public function setStudentId(int $studentId): void
    {
        $this->studentId = $studentId;
    }

    public function getStudentGpa(): float
    {
        return $this->studentGpa;
    }

    public function setStudentGpa(float $studentGpa): void
    {
        $this->studentGpa = $studentGpa;
    }

    public function getStudentName(): string
    {
        return $this->studentName;
    }

    public function setStudentName(string $studentName): void
    {
        $this->studentName = $studentName;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function toDto(): StudentsDto
    {
        $dto = new StudentsDto();
        $dto->studentId = (int) ($this->studentId ?? 0);
        $dto->studentGpa = (float) ($this->studentGpa ?? 0);
        $dto->studentName = $this->studentName ?? "";
        $dto->personId = (int) ($this->personId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "student_id" => $this->studentId,
            "student_gpa" => $this->studentGpa,
            "student_name" => $this->studentName,
            "person_id" => $this->personId,
        ];
    }
}