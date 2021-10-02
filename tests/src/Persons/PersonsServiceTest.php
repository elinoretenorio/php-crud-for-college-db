<?php

declare(strict_types=1);

namespace College\Tests\Persons;

use PHPUnit\Framework\TestCase;
use College\Persons\{ PersonsDto, PersonsModel, IPersonsService, PersonsService };

class PersonsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PersonsDto $dto;
    private PersonsModel $model;
    private IPersonsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("College\Persons\IPersonsRepository");
        $this->input = [
            "person_id" => 2152,
            "person_phone_number" => "must",
            "person_name" => "network",
        ];
        $this->dto = new PersonsDto($this->input);
        $this->model = new PersonsModel($this->dto);
        $this->service = new PersonsService($this->repository);
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
        $expected = 2056;

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
        $expected = 4243;

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
        $personId = 7077;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($personId)
            ->willReturn(null);

        $actual = $this->service->get($personId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $personId = 4682;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($personId)
            ->willReturn($this->dto);

        $actual = $this->service->get($personId);
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
        $personId = 4544;
        $expected = 1415;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($personId)
            ->willReturn($expected);

        $actual = $this->service->delete($personId);
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