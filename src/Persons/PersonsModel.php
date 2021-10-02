<?php

declare(strict_types=1);

namespace College\Persons;

use JsonSerializable;

class PersonsModel implements JsonSerializable
{
    private int $personId;
    private string $personPhoneNumber;
    private string $personName;

    public function __construct(PersonsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->personId = $dto->personId;
        $this->personPhoneNumber = $dto->personPhoneNumber;
        $this->personName = $dto->personName;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function getPersonPhoneNumber(): string
    {
        return $this->personPhoneNumber;
    }

    public function setPersonPhoneNumber(string $personPhoneNumber): void
    {
        $this->personPhoneNumber = $personPhoneNumber;
    }

    public function getPersonName(): string
    {
        return $this->personName;
    }

    public function setPersonName(string $personName): void
    {
        $this->personName = $personName;
    }

    public function toDto(): PersonsDto
    {
        $dto = new PersonsDto();
        $dto->personId = (int) ($this->personId ?? 0);
        $dto->personPhoneNumber = $this->personPhoneNumber ?? "";
        $dto->personName = $this->personName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "person_id" => $this->personId,
            "person_phone_number" => $this->personPhoneNumber,
            "person_name" => $this->personName,
        ];
    }
}