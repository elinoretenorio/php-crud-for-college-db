<?php

declare(strict_types=1);

namespace College\Interns;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class InternsRepository implements IInternsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(InternsDto $dto): int
    {
        $sql = "INSERT INTO `interns` (`person_id`, `intern_hourly_wage`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->personId,
                $dto->internHourlyWage
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(InternsDto $dto): int
    {
        $sql = "UPDATE `interns` SET `person_id` = ?, `intern_hourly_wage` = ?
                WHERE `intern_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->personId,
                $dto->internHourlyWage,
                $dto->internId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $internId): ?InternsDto
    {
        $sql = "SELECT `intern_id`, `person_id`, `intern_hourly_wage`
                FROM `interns` WHERE `intern_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$internId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new InternsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `intern_id`, `person_id`, `intern_hourly_wage`
                FROM `interns`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new InternsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $internId): int
    {
        $sql = "DELETE FROM `interns` WHERE `intern_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$internId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}