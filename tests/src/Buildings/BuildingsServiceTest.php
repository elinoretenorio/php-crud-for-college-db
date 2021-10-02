<?php

declare(strict_types=1);

namespace College\Tests\Buildings;

use PHPUnit\Framework\TestCase;
use College\Buildings\{ BuildingsDto, BuildingsModel, IBuildingsService, BuildingsService };

class BuildingsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private BuildingsDto $dto;
    private BuildingsModel $model;
    private IBuildingsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Buildings\IBuildingsRepository");
        $this->input = [
            "building_id" => 2658,
            "building_name" => "image",
            "college_name" => "fast",
        ];
        $this->dto = new BuildingsDto($this->input);
        $this->model = new BuildingsModel($this->dto);
        $this->service = new BuildingsService($this->repository);
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
        $expected = 6564;

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
        $expected = 5827;

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
        $buildingId = 6603;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($buildingId)
            ->willReturn(null);

        $actual = $this->service->get($buildingId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $buildingId = 1341;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($buildingId)
            ->willReturn($this->dto);

        $actual = $this->service->get($buildingId);
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
        $buildingId = 8011;
        $expected = 9435;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($buildingId)
            ->willReturn($expected);

        $actual = $this->service->delete($buildingId);
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