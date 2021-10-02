<?php

declare(strict_types=1);

namespace College\Textbooks;

use College\Database\IDatabase;
use College\Database\DatabaseException;

class TextbooksRepository implements ITextbooksRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(TextbooksDto $dto): int
    {
        $sql = "INSERT INTO `textbooks` (`textbook_isbn`, `textbook_title`, `textbook_author`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->textbookIsbn,
                $dto->textbookTitle,
                $dto->textbookAuthor
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(TextbooksDto $dto): int
    {
        $sql = "UPDATE `textbooks` SET `textbook_isbn` = ?, `textbook_title` = ?, `textbook_author` = ?
                WHERE `textbook_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->textbookIsbn,
                $dto->textbookTitle,
                $dto->textbookAuthor,
                $dto->textbookId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $textbookId): ?TextbooksDto
    {
        $sql = "SELECT `textbook_id`, `textbook_isbn`, `textbook_title`, `textbook_author`
                FROM `textbooks` WHERE `textbook_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$textbookId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new TextbooksDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `textbook_id`, `textbook_isbn`, `textbook_title`, `textbook_author`
                FROM `textbooks`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new TextbooksDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $textbookId): int
    {
        $sql = "DELETE FROM `textbooks` WHERE `textbook_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$textbookId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}