<?php

declare(strict_types=1);

namespace College\Tests\Courses;

use PHPUnit\Framework\TestCase;
use College\Database\DatabaseException;
use College\Courses\{ CoursesDto, ICoursesRepository, CoursesRepository };

class CoursesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CoursesDto $dto;
    private ICoursesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("College\Database\IDatabase");
        $this->result = $this->createMock("College\Database\IDatabaseResult");
        $this->input = [
            "course_id" => 3047,
            "course_name" => "smile",
            "textbook_isbn" => 1428,
        ];
        $this->dto = new CoursesDto($this->input);
        $this->repository = new CoursesRepository($this->db);
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
        $expected = 5520;

        $sql = "INSERT INTO `courses` (`course_name`, `textbook_isbn`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->courseName,
                $this->dto->textbookIsbn
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
        $expected = 2643;

        $sql = "UPDATE `courses` SET `course_name` = ?, `textbook_isbn` = ?
                WHERE `course_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->courseName,
                $this->dto->textbookIsbn,
                $this->dto->courseId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $courseId = 828;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($courseId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $courseId = 6593;

        $sql = "SELECT `course_id`, `course_name`, `textbook_isbn`
                FROM `courses` WHERE `course_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$courseId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($courseId);
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
        $sql = "SELECT `course_id`, `course_name`, `textbook_isbn`
                FROM `courses`";

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
        $courseId = 1233;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($courseId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $courseId = 3543;
        $expected = 5600;

        $sql = "DELETE FROM `courses` WHERE `course_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$courseId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($courseId);
        $this->assertEquals($expected, $actual);
    }
}