<?php

declare(strict_types=1);

namespace College\Textbooks;

use JsonSerializable;

class TextbooksModel implements JsonSerializable
{
    private int $textbookId;
    private int $textbookIsbn;
    private string $textbookTitle;
    private string $textbookAuthor;

    public function __construct(TextbooksDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->textbookId = $dto->textbookId;
        $this->textbookIsbn = $dto->textbookIsbn;
        $this->textbookTitle = $dto->textbookTitle;
        $this->textbookAuthor = $dto->textbookAuthor;
    }

    public function getTextbookId(): int
    {
        return $this->textbookId;
    }

    public function setTextbookId(int $textbookId): void
    {
        $this->textbookId = $textbookId;
    }

    public function getTextbookIsbn(): int
    {
        return $this->textbookIsbn;
    }

    public function setTextbookIsbn(int $textbookIsbn): void
    {
        $this->textbookIsbn = $textbookIsbn;
    }

    public function getTextbookTitle(): string
    {
        return $this->textbookTitle;
    }

    public function setTextbookTitle(string $textbookTitle): void
    {
        $this->textbookTitle = $textbookTitle;
    }

    public function getTextbookAuthor(): string
    {
        return $this->textbookAuthor;
    }

    public function setTextbookAuthor(string $textbookAuthor): void
    {
        $this->textbookAuthor = $textbookAuthor;
    }

    public function toDto(): TextbooksDto
    {
        $dto = new TextbooksDto();
        $dto->textbookId = (int) ($this->textbookId ?? 0);
        $dto->textbookIsbn = (int) ($this->textbookIsbn ?? 0);
        $dto->textbookTitle = $this->textbookTitle ?? "";
        $dto->textbookAuthor = $this->textbookAuthor ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "textbook_id" => $this->textbookId,
            "textbook_isbn" => $this->textbookIsbn,
            "textbook_title" => $this->textbookTitle,
            "textbook_author" => $this->textbookAuthor,
        ];
    }
}