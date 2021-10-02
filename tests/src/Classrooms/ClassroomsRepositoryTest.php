<?php

declare(strict_types=1);

namespace College\Tests\Classrooms;

use PHPUnit\Framework\TestCase;
use College\Database\DatabaseException;
use College\Classrooms\{ ClassroomsDto, IClassroomsRepository, ClassroomsRepository };

class ClassroomsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ClassroomsDto $dto;
    private IClassroomsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("College\Database\IDatabase");
        $this->result = $this->createMock("College\Database\IDatabaseResult");
        $this->input = [
            "classroom_id" => 8935,
            "room_number" => 9294,
            "has_projector" => True,
            "building_id" => 188,
        ];
        $this->dto = new ClassroomsDto($this->input);
        $this->repository = new ClassroomsRepository($this->db);
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
        $expected = 5245;

        $sql = "INSERT INTO `classrooms` (`room_number`, `has_projector`, `building_id`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->roomNumber,
                $this->dto->hasProjector,
                $this->dto->buildingId
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
        $expected = 7727;

        $sql = "UPDATE `classrooms` SET `room_number` = ?, `has_projector` = ?, `building_id` = ?
                WHERE `classroom_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->roomNumber,
                $this->dto->hasProjector,
                $this->dto->buildingId,
                $this->dto->classroomId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $classroomId = 6051;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($classroomId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $classroomId = 605;

        $sql = "SELECT `classroom_id`, `room_number`, `has_projector`, `building_id`
                FROM `classrooms` WHERE `classroom_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$classroomId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($classroomId);
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
        $sql = "SELECT `classroom_id`, `room_number`, `has_projector`, `building_id`
                FROM `classrooms`";

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
        $classroomId = 270;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($classroomId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $classroomId = 47;
        $expected = 660;

        $sql = "DELETE FROM `classrooms` WHERE `classroom_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$classroomId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($classroomId);
        $this->assertEquals($expected, $actual);
    }
}