<?php

declare(strict_types=1);

namespace College\Tests\Textbooks;

use PHPUnit\Framework\TestCase;
use College\Database\DatabaseException;
use College\Textbooks\{ TextbooksDto, ITextbooksRepository, TextbooksRepository };

class TextbooksRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private TextbooksDto $dto;
    private ITextbooksRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("College\Database\IDatabase");
        $this->result = $this->createMock("College\Database\IDatabaseResult");
        $this->input = [
            "textbook_id" => 5350,
            "textbook_isbn" => 8763,
            "textbook_title" => "stay",
            "textbook_author" => "pick",
        ];
        $this->dto = new TextbooksDto($this->input);
        $this->repository = new TextbooksRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 2150;

        $sql = "INSERT INTO `textbooks` (`textbook_isbn`, `textbook_title`, `textbook_author`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->textbookIsbn,
                $this->dto->textbookTitle,
                $this->dto->textbookAuthor
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 8760;

        $sql = "UPDATE `textbooks` SET `textbook_isbn` = ?, `textbook_title` = ?, `textbook_author` = ?
                WHERE `textbook_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->textbookIsbn,
                $this->dto->textbookTitle,
                $this->dto->textbookAuthor,
                $this->dto->textbookId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $textbookId = 123;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($textbookId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $textbookId = 9505;

        $sql = "SELECT `textbook_id`, `textbook_isbn`, `textbook_title`, `textbook_author`
                FROM `textbooks` WHERE `textbook_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$textbookId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($textbookId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `textbook_id`, `textbook_isbn`, `textbook_title`, `textbook_author`
                FROM `textbooks`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $textbookId = 4265;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($textbookId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $textbookId = 3034;
        $expected = 7481;

        $sql = "DELETE FROM `textbooks` WHERE `textbook_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$textbookId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($textbookId);
        $this->assertEquals($expected, $actual);
    }
}