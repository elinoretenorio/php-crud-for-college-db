<?php

declare(strict_types=1);

namespace College\Tests\Colleges;

use PHPUnit\Framework\TestCase;
use College\Colleges\{ CollegesDto, CollegesModel, ICollegesService, CollegesService };

class CollegesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CollegesDto $dto;
    private CollegesModel $model;
    private ICollegesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Colleges\ICollegesRepository");
        $this->input = [
            "college_id" => 1234,
            "college_name" => "letter",
            "college_total_students" => 4897,
        ];
        $this->dto = new CollegesDto($this->input);
        $this->model = new CollegesModel($this->dto);
        $this->service = new CollegesService($this->repository);
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
        $expected = 6098;

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
        $expected = 450;

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
        $collegeId = 8385;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($collegeId)
            ->willReturn(null);

        $actual = $this->service->get($collegeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $collegeId = 9458;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($collegeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($collegeId);
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
        $collegeId = 4825;
        $expected = 6474;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($collegeId)
            ->willReturn($expected);

        $actual = $this->service->delete($collegeId);
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