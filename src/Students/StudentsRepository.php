<?php

declare(strict_types=1);

namespace College\Students;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class StudentsRepository implements IStudentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(StudentsDto $dto): int
    {
        $sql = "INSERT INTO `students` (`student_gpa`, `student_name`, `person_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->studentGpa,
                $dto->studentName,
                $dto->personId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(StudentsDto $dto): int
    {
        $sql = "UPDATE `students` SET `student_gpa` = ?, `student_name` = ?, `person_id` = ?
                WHERE `student_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->studentGpa,
                $dto->studentName,
                $dto->personId,
                $dto->studentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $studentId): ?StudentsDto
    {
        $sql = "SELECT `student_id`, `student_gpa`, `student_name`, `person_id`
                FROM `students` WHERE `student_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$studentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new StudentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `student_id`, `student_gpa`, `student_name`, `person_id`
                FROM `students`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new StudentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $studentId): int
    {
        $sql = "DELETE FROM `students` WHERE `student_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$studentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}