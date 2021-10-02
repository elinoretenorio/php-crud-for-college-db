<?php

declare(strict_types=1);

namespace College\Sections;

use JsonSerializable;

class SectionsModel implements JsonSerializable
{
    private int $sectionId;
    private string $sectionDate;
    private int $roomNumber;
    private int $courseId;
    private int $buildingId;
    private int $personId;

    public function __construct(SectionsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->sectionId = $dto->sectionId;
        $this->sectionDate = $dto->sectionDate;
        $this->roomNumber = $dto->roomNumber;
        $this->courseId = $dto->courseId;
        $this->buildingId = $dto->buildingId;
        $this->personId = $dto->personId;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    public function setSectionId(int $sectionId): void
    {
        $this->sectionId = $sectionId;
    }

    public function getSectionDate(): string
    {
        return $this->sectionDate;
    }

    public function setSectionDate(string $sectionDate): void
    {
        $this->sectionDate = $sectionDate;
    }

    public function getRoomNumber(): int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): void
    {
        $this->roomNumber = $roomNumber;
    }

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function setCourseId(int $courseId): void
    {
        $this->courseId = $courseId;
    }

    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    public function setBuildingId(int $buildingId): void
    {
        $this->buildingId = $buildingId;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function toDto(): SectionsDto
    {
        $dto = new SectionsDto();
        $dto->sectionId = (int) ($this->sectionId ?? 0);
        $dto->sectionDate = $this->sectionDate ?? "";
        $dto->roomNumber = (int) ($this->roomNumber ?? 0);
        $dto->courseId = (int) ($this->courseId ?? 0);
        $dto->buildingId = (int) ($this->buildingId ?? 0);
        $dto->personId = (int) ($this->personId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "section_id" => $this->sectionId,
            "section_date" => $this->sectionDate,
            "room_number" => $this->roomNumber,
            "course_id" => $this->courseId,
            "building_id" => $this->buildingId,
            "person_id" => $this->personId,
        ];
    }
}