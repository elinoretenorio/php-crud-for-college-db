<?php

declare(strict_types=1);

namespace College\Tests\Textbooks;

use PHPUnit\Framework\TestCase;
use College\Textbooks\{ TextbooksDto, TextbooksModel };

class TextbooksModelTest extends TestCase
{
    private array $input;
    private TextbooksDto $dto;
    private TextbooksModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "textbook_id" => 2305,
            "textbook_isbn" => 5747,
            "textbook_title" => "society",
            "textbook_author" => "top",
        ];
        $this->dto = new TextbooksDto($this->input);
        $this->model = new TextbooksModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new TextbooksModel(null);

        $this->assertInstanceOf(TextbooksModel::class, $model);
    }

    public function testGetTextbookId(): void
    {
        $this->assertEquals($this->dto->textbookId, $this->model->getTextbookId());
    }

    public function testSetTextbookId(): void
    {
        $expected = 2023;
        $model = $this->model;
        $model->setTextbookId($expected);

        $this->assertEquals($expected, $model->getTextbookId());
    }

    public function testGetTextbookIsbn(): void
    {
        $this->assertEquals($this->dto->textbookIsbn, $this->model->getTextbookIsbn());
    }

    public function testSetTextbookIsbn(): void
    {
        $expected = 3052;
        $model = $this->model;
        $model->setTextbookIsbn($expected);

        $this->assertEquals($expected, $model->getTextbookIsbn());
    }

    public function testGetTextbookTitle(): void
    {
        $this->assertEquals($this->dto->textbookTitle, $this->model->getTextbookTitle());
    }

    public function testSetTextbookTitle(): void
    {
        $expected = "party";
        $model = $this->model;
        $model->setTextbookTitle($expected);

        $this->assertEquals($expected, $model->getTextbookTitle());
    }

    public function testGetTextbookAuthor(): void
    {
        $this->assertEquals($this->dto->textbookAuthor, $this->model->getTextbookAuthor());
    }

    public function testSetTextbookAuthor(): void
    {
        $expected = "break";
        $model = $this->model;
        $model->setTextbookAuthor($expected);

        $this->assertEquals($expected, $model->getTextbookAuthor());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}