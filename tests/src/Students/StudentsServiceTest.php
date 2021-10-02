<?php

declare(strict_types=1);

namespace College\Tests\Students;

use PHPUnit\Framework\TestCase;
use College\Students\{ StudentsDto, StudentsModel, IStudentsService, StudentsService };

class StudentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private StudentsDto $dto;
    private StudentsModel $model;
    private IStudentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Students\IStudentsRepository");
        $this->input = [
            "student_id" => 9235,
            "student_gpa" => 273.00,
            "student_name" => "deep",
            "person_id" => 4373,
        ];
        $this->dto = new StudentsDto($this->input);
        $this->model = new StudentsModel($this->dto);
        $this->service = new StudentsService($this->repository);
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
        $expected = 7983;

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
        $expected = 2997;

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
        $studentId = 5345;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($studentId)
            ->willReturn(null);

        $actual = $this->service->get($studentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $studentId = 2963;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($studentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($studentId);
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
        $studentId = 8224;
        $expected = 8391;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($studentId)
            ->willReturn($expected);

        $actual = $this->service->delete($studentId);
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