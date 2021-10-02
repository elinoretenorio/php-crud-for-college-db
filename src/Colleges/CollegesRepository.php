<?php

declare(strict_types=1);

namespace College\Colleges;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class CollegesRepository implements ICollegesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CollegesDto $dto): int
    {
        $sql = "INSERT INTO `colleges` (`college_name`, `college_total_students`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->collegeName,
                $dto->collegeTotalStudents
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CollegesDto $dto): int
    {
        $sql = "UPDATE `colleges` SET `college_name` = ?, `college_total_students` = ?
                WHERE `college_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->collegeName,
                $dto->collegeTotalStudents,
                $dto->collegeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $collegeId): ?CollegesDto
    {
        $sql = "SELECT `college_id`, `college_name`, `college_total_students`
                FROM `colleges` WHERE `college_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$collegeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CollegesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `college_id`, `college_name`, `college_total_students`
                FROM `colleges`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CollegesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $collegeId): int
    {
        $sql = "DELETE FROM `colleges` WHERE `college_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$collegeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}