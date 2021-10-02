<?php

declare(strict_types=1);

namespace College\Tests\Textbooks;

use PHPUnit\Framework\TestCase;
use College\Textbooks\{ TextbooksDto, TextbooksModel, ITextbooksService, TextbooksService };

class TextbooksServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private TextbooksDto $dto;
    private TextbooksModel $model;
    private ITextbooksService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Textbooks\ITextbooksRepository");
        $this->input = [
            "textbook_id" => 1534,
            "textbook_isbn" => 4913,
            "textbook_title" => "none",
            "textbook_author" => "him",
        ];
        $this->dto = new TextbooksDto($this->input);
        $this->model = new TextbooksModel($this->dto);
        $this->service = new TextbooksService($this->repository);
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
        $expected = 2289;

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
        $expected = 3118;

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
        $textbookId = 3098;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($textbookId)
            ->willReturn(null);

        $actual = $this->service->get($textbookId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $textbookId = 2022;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($textbookId)
            ->willReturn($this->dto);

        $actual = $this->service->get($textbookId);
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
        $textbookId = 4465;
        $expected = 5202;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($textbookId)
            ->willReturn($expected);

        $actual = $this->service->delete($textbookId);
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