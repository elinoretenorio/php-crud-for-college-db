<?php

declare(strict_types=1);

namespace College\Tests\Faculties;

use PHPUnit\Framework\TestCase;
use College\Faculties\{ FacultiesDto, FacultiesModel };

class FacultiesModelTest extends TestCase
{
    private array $input;
    private FacultiesDto $dto;
    private FacultiesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "faculty_id" => 8786,
            "faculty_salary" => 364.00,
            "faculty_name" => "push",
            "person_id" => 4204,
        ];
        $this->dto = new FacultiesDto($this->input);
        $this->model = new FacultiesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new FacultiesModel(null);

        $this->assertInstanceOf(FacultiesModel::class, $model);
    }

    public function testGetFacultyId(): void
    {
        $this->assertEquals($this->dto->facultyId, $this->model->getFacultyId());
    }

    public function testSetFacultyId(): void
    {
        $expected = 9753;
        $model = $this->model;
        $model->setFacultyId($expected);

        $this->assertEquals($expected, $model->getFacultyId());
    }

    public function testGetFacultySalary(): void
    {
        $this->assertEquals($this->dto->facultySalary, $this->model->getFacultySalary());
    }

    public function testSetFacultySalary(): void
    {
        $expected = 312.30;
        $model = $this->model;
        $model->setFacultySalary($expected);

        $this->assertEquals($expected, $model->getFacultySalary());
    }

    public function testGetFacultyName(): void
    {
        $this->assertEquals($this->dto->facultyName, $this->model->getFacultyName());
    }

    public function testSetFacultyName(): void
    {
        $expected = "discussion";
        $model = $this->model;
        $model->setFacultyName($expected);

        $this->assertEquals($expected, $model->getFacultyName());
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 7778;
        $model = $this->model;
        $model->setPersonId($expected);

        $this->assertEquals($expected, $model->getPersonId());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}