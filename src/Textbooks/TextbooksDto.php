<?php

declare(strict_types=1);

namespace College\Textbooks;

class TextbooksDto 
{
    public int $textbookId;
    public int $textbookIsbn;
    public string $textbookTitle;
    public string $textbookAuthor;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->textbookId = (int) ($row["textbook_id"] ?? 0);
        $this->textbookIsbn = (int) ($row["textbook_isbn"] ?? 0);
        $this->textbookTitle = $row["textbook_title"] ?? "";
        $this->textbookAuthor = $row["textbook_author"] ?? "";
    }
}