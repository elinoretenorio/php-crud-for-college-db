<?php

declare(strict_types=1);

namespace College\Tests\Interns;

use PHPUnit\Framework\TestCase;
use College\Database\DatabaseException;
use College\Interns\{ InternsDto, IInternsRepository, InternsRepository };

class InternsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private InternsDto $dto;
    private IInternsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("College\Database\IDatabase");
        $this->result = $this->createMock("College\Database\IDatabaseResult");
        $this->input = [
            "intern_id" => 8150,
            "person_id" => 894,
            "intern_hourly_wage" => 881.34,
        ];
        $this->dto = new InternsDto($this->input);
        $this->repository = new InternsRepository($this->db);
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
        $expected = 5127;

        $sql = "INSERT INTO `interns` (`person_id`, `intern_hourly_wage`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->personId,
                $this->dto->internHourlyWage
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
        $expected = 236;

        $sql = "UPDATE `interns` SET `person_id` = ?, `intern_hourly_wage` = ?
                WHERE `intern_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->personId,
                $this->dto->internHourlyWage,
                $this->dto->internId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $internId = 2698;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($internId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $internId = 80;

        $sql = "SELECT `intern_id`, `person_id`, `intern_hourly_wage`
                FROM `interns` WHERE `intern_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$internId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($internId);
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
        $sql = "SELECT `intern_id`, `person_id`, `intern_hourly_wage`
                FROM `interns`";

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
        $internId = 4416;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($internId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $internId = 3014;
        $expected = 9285;

        $sql = "DELETE FROM `interns` WHERE `intern_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$internId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($internId);
        $this->assertEquals($expected, $actual);
    }
}