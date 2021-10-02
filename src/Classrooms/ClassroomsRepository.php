<?php

declare(strict_types=1);

namespace College\Classrooms;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class ClassroomsRepository implements IClassroomsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ClassroomsDto $dto): int
    {
        $sql = "INSERT INTO `classrooms` (`room_number`, `has_projector`, `building_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->roomNumber,
                $dto->hasProjector,
                $dto->buildingId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ClassroomsDto $dto): int
    {
        $sql = "UPDATE `classrooms` SET `room_number` = ?, `has_projector` = ?, `building_id` = ?
                WHERE `classroom_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->roomNumber,
                $dto->hasProjector,
                $dto->buildingId,
                $dto->classroomId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $classroomId): ?ClassroomsDto
    {
        $sql = "SELECT `classroom_id`, `room_number`, `has_projector`, `building_id`
                FROM `classrooms` WHERE `classroom_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$classroomId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ClassroomsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `classroom_id`, `room_number`, `has_projector`, `building_id`
                FROM `classrooms`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ClassroomsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $classroomId): int
    {
        $sql = "DELETE FROM `classrooms` WHERE `classroom_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$classroomId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}