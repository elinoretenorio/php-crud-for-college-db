<?php

declare(strict_types=1);

namespace College\Tests\Faculties;

use PHPUnit\Framework\TestCase;
use College\Faculties\{ FacultiesDto, FacultiesModel, IFacultiesService, FacultiesService };

class FacultiesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private FacultiesDto $dto;
    private FacultiesModel $model;
    private IFacultiesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Faculties\IFacultiesRepository");
        $this->input = [
            "faculty_id" => 8473,
            "faculty_salary" => 178.70,
            "faculty_name" => "tree",
            "person_id" => 9144,
        ];
        $this->dto = new FacultiesDto($this->input);
        $this->model = new FacultiesModel($this->dto);
        $this->service = new FacultiesService($this->repository);
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
        $expected = 4421;

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
        $expected = 7719;

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
        $facultyId = 9984;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($facultyId)
            ->willReturn(null);

        $actual = $this->service->get($facultyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $facultyId = 6879;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($facultyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($facultyId);
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
        $facultyId = 2222;
        $expected = 1424;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($facultyId)
            ->willReturn($expected);

        $actual = $this->service->delete($facultyId);
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