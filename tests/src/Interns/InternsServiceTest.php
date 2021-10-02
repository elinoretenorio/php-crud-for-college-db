<?php

declare(strict_types=1);

namespace College\Tests\Interns;

use PHPUnit\Framework\TestCase;
use College\Interns\{ InternsDto, InternsModel, IInternsService, InternsService };

class InternsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private InternsDto $dto;
    private InternsModel $model;
    private IInternsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Interns\IInternsRepository");
        $this->input = [
            "intern_id" => 5926,
            "person_id" => 8968,
            "intern_hourly_wage" => 789.85,
        ];
        $this->dto = new InternsDto($this->input);
        $this->model = new InternsModel($this->dto);
        $this->service = new InternsService($this->repository);
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
        $expected = 3666;

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
        $expected = 7097;

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
        $internId = 4814;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($internId)
            ->willReturn(null);

        $actual = $this->service->get($internId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $internId = 3123;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($internId)
            ->willReturn($this->dto);

        $actual = $this->service->get($internId);
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
        $internId = 2648;
        $expected = 2715;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($internId)
            ->willReturn($expected);

        $actual = $this->service->delete($internId);
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