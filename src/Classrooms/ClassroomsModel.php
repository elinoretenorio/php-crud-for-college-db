<?php

declare(strict_types=1);

namespace College\Classrooms;

use JsonSerializable;

class ClassroomsModel implements JsonSerializable
{
    private int $classroomId;
    private int $roomNumber;
    private bool $hasProjector;
    private int $buildingId;

    public function __construct(ClassroomsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->classroomId = $dto->classroomId;
        $this->roomNumber = $dto->roomNumber;
        $this->hasProjector = $dto->hasProjector;
        $this->buildingId = $dto->buildingId;
    }

    public function getClassroomId(): int
    {
        return $this->classroomId;
    }

    public function setClassroomId(int $classroomId): void
    {
        $this->classroomId = $classroomId;
    }

    public function getRoomNumber(): int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): void
    {
        $this->roomNumber = $roomNumber;
    }

    public function getHasProjector(): bool
    {
        return $this->hasProjector;
    }

    public function setHasProjector(bool $hasProjector): void
    {
        $this->hasProjector = $hasProjector;
    }

    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    public function setBuildingId(int $buildingId): void
    {
        $this->buildingId = $buildingId;
    }

    public function toDto(): ClassroomsDto
    {
        $dto = new ClassroomsDto();
        $dto->classroomId = (int) ($this->classroomId ?? 0);
        $dto->roomNumber = (int) ($this->roomNumber ?? 0);
        $dto->hasProjector = (bool) $this->hasProjector;
        $dto->buildingId = (int) ($this->buildingId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "classroom_id" => $this->classroomId,
            "room_number" => $this->roomNumber,
            "has_projector" => $this->hasProjector,
            "building_id" => $this->buildingId,
        ];
    }
}