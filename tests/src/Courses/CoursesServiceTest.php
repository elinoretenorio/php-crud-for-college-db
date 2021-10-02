<?php

declare(strict_types=1);

namespace College\Tests\Courses;

use PHPUnit\Framework\TestCase;
use College\Courses\{ CoursesDto, CoursesModel, ICoursesService, CoursesService };

class CoursesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CoursesDto $dto;
    private CoursesModel $model;
    private ICoursesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Courses\ICoursesRepository");
        $this->input = [
            "course_id" => 3107,
            "course_name" => "morning",
            "textbook_isbn" => 9583,
        ];
        $this->dto = new CoursesDto($this->input);
        $this->model = new CoursesModel($this->dto);
        $this->service = new CoursesService($this->repository);
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
        $expected = 2505;

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
        $expected = 5648;

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
        $courseId = 6525;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($courseId)
            ->willReturn(null);

        $actual = $this->service->get($courseId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $courseId = 2550;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($courseId)
            ->willReturn($this->dto);

        $actual = $this->service->get($courseId);
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
        $courseId = 9249;
        $expected = 1891;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($courseId)
            ->willReturn($expected);

        $actual = $this->service->delete($courseId);
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