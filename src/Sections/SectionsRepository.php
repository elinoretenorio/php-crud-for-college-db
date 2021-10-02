<?php

declare(strict_types=1);

namespace College\Sections;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class SectionsRepository implements ISectionsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(SectionsDto $dto): int
    {
        $sql = "INSERT INTO `sections` (`section_date`, `room_number`, `course_id`, `building_id`, `person_id`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->sectionDate,
                $dto->roomNumber,
                $dto->courseId,
                $dto->buildingId,
                $dto->personId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(SectionsDto $dto): int
    {
        $sql = "UPDATE `sections` SET `section_date` = ?, `room_number` = ?, `course_id` = ?, `building_id` = ?, `person_id` = ?
                WHERE `section_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->sectionDate,
                $dto->roomNumber,
                $dto->courseId,
                $dto->buildingId,
                $dto->personId,
                $dto->sectionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $sectionId): ?SectionsDto
    {
        $sql = "SELECT `section_id`, `section_date`, `room_number`, `course_id`, `building_id`, `person_id`
                FROM `sections` WHERE `section_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$sectionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new SectionsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `section_id`, `section_date`, `room_number`, `course_id`, `building_id`, `person_id`
                FROM `sections`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new SectionsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $sectionId): int
    {
        $sql = "DELETE FROM `sections` WHERE `section_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$sectionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}