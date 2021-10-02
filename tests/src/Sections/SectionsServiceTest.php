<?php

declare(strict_types=1);

namespace College\Tests\Sections;

use PHPUnit\Framework\TestCase;
use College\Sections\{ SectionsDto, SectionsModel, ISectionsService, SectionsService };

class SectionsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private SectionsDto $dto;
    private SectionsModel $model;
    private ISectionsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Sections\ISectionsRepository");
        $this->input = [
            "section_id" => 124,
            "section_date" => "2021-09-28",
            "room_number" => 4466,
            "course_id" => 9865,
            "building_id" => 1655,
            "person_id" => 3180,
        ];
        $this->dto = new SectionsDto($this->input);
        $this->model = new SectionsModel($this->dto);
        $this->service = new SectionsService($this->repository);
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
        $expected = 7355;

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
        $expected = 2518;

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
        $sectionId = 6314;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($sectionId)
            ->willReturn(null);

        $actual = $this->service->get($sectionId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $sectionId = 2729;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($sectionId)
            ->willReturn($this->dto);

        $actual = $this->service->get($sectionId);
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
        $sectionId = 2191;
        $expected = 6653;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($sectionId)
            ->willReturn($expected);

        $actual = $this->service->delete($sectionId);
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