<?php

declare(strict_types=1);

namespace College\Tests\Sections;

use PHPUnit\Framework\TestCase;
use College\Database\DatabaseException;
use College\Sections\{ SectionsDto, ISectionsRepository, SectionsRepository };

class SectionsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private SectionsDto $dto;
    private ISectionsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("College\Database\IDatabase");
        $this->result = $this->createMock("College\Database\IDatabaseResult");
        $this->input = [
            "section_id" => 4867,
            "section_date" => "2021-09-28",
            "room_number" => 4499,
            "course_id" => 3121,
            "building_id" => 9167,
            "person_id" => 9588,
        ];
        $this->dto = new SectionsDto($this->input);
        $this->repository = new SectionsRepository($this->db);
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
        $expected = 6319;

        $sql = "INSERT INTO `sections` (`section_date`, `room_number`, `course_id`, `building_id`, `person_id`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->sectionDate,
                $this->dto->roomNumber,
                $this->dto->courseId,
                $this->dto->buildingId,
                $this->dto->personId
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
        $expected = 6117;

        $sql = "UPDATE `sections` SET `section_date` = ?, `room_number` = ?, `course_id` = ?, `building_id` = ?, `person_id` = ?
                WHERE `section_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->sectionDate,
                $this->dto->roomNumber,
                $this->dto->courseId,
                $this->dto->buildingId,
                $this->dto->personId,
                $this->dto->sectionId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $sectionId = 3076;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($sectionId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $sectionId = 5722;

        $sql = "SELECT `section_id`, `section_date`, `room_number`, `course_id`, `building_id`, `person_id`
                FROM `sections` WHERE `section_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$sectionId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($sectionId);
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
        $sql = "SELECT `section_id`, `section_date`, `room_number`, `course_id`, `building_id`, `person_id`
                FROM `sections`";

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
        $sectionId = 2060;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($sectionId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $sectionId = 6603;
        $expected = 7789;

        $sql = "DELETE FROM `sections` WHERE `section_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$sectionId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($sectionId);
        $this->assertEquals($expected, $actual);
    }
}