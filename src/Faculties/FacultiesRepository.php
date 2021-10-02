<?php

declare(strict_types=1);

namespace College\Faculties;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class FacultiesRepository implements IFacultiesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(FacultiesDto $dto): int
    {
        $sql = "INSERT INTO `faculties` (`faculty_salary`, `faculty_name`, `person_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->facultySalary,
                $dto->facultyName,
                $dto->personId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(FacultiesDto $dto): int
    {
        $sql = "UPDATE `faculties` SET `faculty_salary` = ?, `faculty_name` = ?, `person_id` = ?
                WHERE `faculty_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->facultySalary,
                $dto->facultyName,
                $dto->personId,
                $dto->facultyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $facultyId): ?FacultiesDto
    {
        $sql = "SELECT `faculty_id`, `faculty_salary`, `faculty_name`, `person_id`
                FROM `faculties` WHERE `faculty_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$facultyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new FacultiesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `faculty_id`, `faculty_salary`, `faculty_name`, `person_id`
                FROM `faculties`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new FacultiesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $facultyId): int
    {
        $sql = "DELETE FROM `faculties` WHERE `faculty_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$facultyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}