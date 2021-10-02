<?php

declare(strict_types=1);

namespace College\Buildings;

use JsonSerializable;

class BuildingsModel implements JsonSerializable
{
    private int $buildingId;
    private string $buildingName;
    private string $collegeName;

    public function __construct(BuildingsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->buildingId = $dto->buildingId;
        $this->buildingName = $dto->buildingName;
        $this->collegeName = $dto->collegeName;
    }

    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    public function setBuildingId(int $buildingId): void
    {
        $this->buildingId = $buildingId;
    }

    public function getBuildingName(): string
    {
        return $this->buildingName;
    }

    public function setBuildingName(string $buildingName): void
    {
        $this->buildingName = $buildingName;
    }

    public function getCollegeName(): string
    {
        return $this->collegeName;
    }

    public function setCollegeName(string $collegeName): void
    {
        $this->collegeName = $collegeName;
    }

    public function toDto(): BuildingsDto
    {
        $dto = new BuildingsDto();
        $dto->buildingId = (int) ($this->buildingId ?? 0);
        $dto->buildingName = $this->buildingName ?? "";
        $dto->collegeName = $this->collegeName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "building_id" => $this->buildingId,
            "building_name" => $this->buildingName,
            "college_name" => $this->collegeName,
        ];
    }
}