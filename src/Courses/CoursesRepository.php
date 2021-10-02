<?php

declare(strict_types=1);

namespace College\Courses;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class CoursesRepository implements ICoursesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CoursesDto $dto): int
    {
        $sql = "INSERT INTO `courses` (`course_name`, `textbook_isbn`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->courseName,
                $dto->textbookIsbn
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CoursesDto $dto): int
    {
        $sql = "UPDATE `courses` SET `course_name` = ?, `textbook_isbn` = ?
                WHERE `course_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->courseName,
                $dto->textbookIsbn,
                $dto->courseId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $courseId): ?CoursesDto
    {
        $sql = "SELECT `course_id`, `course_name`, `textbook_isbn`
                FROM `courses` WHERE `course_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$courseId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CoursesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `course_id`, `course_name`, `textbook_isbn`
                FROM `courses`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CoursesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $courseId): int
    {
        $sql = "DELETE FROM `courses` WHERE `course_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$courseId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}