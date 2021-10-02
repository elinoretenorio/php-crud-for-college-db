<?php

declare(strict_types=1);

namespace College\Tests\Classrooms;

use PHPUnit\Framework\TestCase;
use College\Classrooms\{ ClassroomsDto, ClassroomsModel, IClassroomsService, ClassroomsService };

class ClassroomsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ClassroomsDto $dto;
    private ClassroomsModel $model;
    private IClassroomsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Classrooms\IClassroomsRepository");
        $this->input = [
            "classroom_id" => 6349,
            "room_number" => 9553,
            "has_projector" => False,
            "building_id" => 9663,
        ];
        $this->dto = new ClassroomsDto($this->input);
        $this->model = new ClassroomsModel($this->dto);
        $this->service = new ClassroomsService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 8037;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 3868;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $classroomId = 5875;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($classroomId)
            ->willReturn(null);

        $actual = $this->service->get($classroomId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $classroomId = 5766;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($classroomId)
            ->willReturn($this->dto);

        $actual = $this->service->get($classroomId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $classroomId = 5674;
        $expected = 7095;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($classroomId)
            ->willReturn($expected);

        $actual = $this->service->delete($classroomId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}