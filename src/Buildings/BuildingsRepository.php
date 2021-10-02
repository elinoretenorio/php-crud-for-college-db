<?php

declare(strict_types=1);

namespace College\Buildings;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class BuildingsRepository implements IBuildingsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(BuildingsDto $dto): int
    {
        $sql = "INSERT INTO `buildings` (`building_name`, `college_name`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->buildingName,
                $dto->collegeName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(BuildingsDto $dto): int
    {
        $sql = "UPDATE `buildings` SET `building_name` = ?, `college_name` = ?
                WHERE `building_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->buildingName,
                $dto->collegeName,
                $dto->buildingId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $buildingId): ?BuildingsDto
    {
        $sql = "SELECT `building_id`, `building_name`, `college_name`
                FROM `buildings` WHERE `building_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$buildingId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new BuildingsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `building_id`, `building_name`, `college_name`
                FROM `buildings`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new BuildingsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $buildingId): int
    {
        $sql = "DELETE FROM `buildings` WHERE `building_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$buildingId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}