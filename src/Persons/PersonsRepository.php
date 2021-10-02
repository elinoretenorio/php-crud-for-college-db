<?php

declare(strict_types=1);

namespace College\Persons;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class PersonsRepository implements IPersonsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PersonsDto $dto): int
    {
        $sql = "INSERT INTO `persons` (`person_phone_number`, `person_name`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->personPhoneNumber,
                $dto->personName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PersonsDto $dto): int
    {
        $sql = "UPDATE `persons` SET `person_phone_number` = ?, `person_name` = ?
                WHERE `person_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->personPhoneNumber,
                $dto->personName,
                $dto->personId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $personId): ?PersonsDto
    {
        $sql = "SELECT `person_id`, `person_phone_number`, `person_name`
                FROM `persons` WHERE `person_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$personId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PersonsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `person_id`, `person_phone_number`, `person_name`
                FROM `persons`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PersonsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $personId): int
    {
        $sql = "DELETE FROM `persons` WHERE `person_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$personId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}