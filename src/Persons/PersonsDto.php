<?php

declare(strict_types=1);

namespace College\Persons;

class PersonsDto 
{
    public int $personId;
    public string $personPhoneNumber;
    public string $personName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->personId = (int) ($row["person_id"] ?? 0);
        $this->personPhoneNumber = $row["person_phone_number"] ?? "";
        $this->personName = $row["person_name"] ?? "";
    }
}