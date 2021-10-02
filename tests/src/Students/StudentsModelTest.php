<?php

declare(strict_types=1);

namespace College\Tests\Students;

use PHPUnit\Framework\TestCase;
use College\Students\{ StudentsDto, StudentsModel };

class StudentsModelTest extends TestCase
{
    private array $input;
    private StudentsDto $dto;
    private StudentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "student_id" => 7492,
            "student_gpa" => 969.60,
            "student_name" => "relate",
            "person_id" => 4616,
        ];
        $this->dto = new StudentsDto($this->input);
        $this->model = new StudentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new StudentsModel(null);

        $this->assertInstanceOf(StudentsModel::class, $model);
    }

    public function testGetStudentId(): void
    {
        $this->assertEquals($this->dto->studentId, $this->model->getStudentId());
    }

    public function testSetStudentId(): void
    {
        $expected = 5604;
        $model = $this->model;
        $model->setStudentId($expected);

        $this->assertEquals($expected, $model->getStudentId());
    }

    public function testGetStudentGpa(): void
    {
        $this->assertEquals($this->dto->studentGpa, $this->model->getStudentGpa());
    }

    public function testSetStudentGpa(): void
    {
        $expected = 774.81;
        $model = $this->model;
        $model->setStudentGpa($expected);

        $this->assertEquals($expected, $model->getStudentGpa());
    }

    public function testGetStudentName(): void
    {
        $this->assertEquals($this->dto->studentName, $this->model->getStudentName());
    }

    public function testSetStudentName(): void
    {
        $expected = "just";
        $model = $this->model;
        $model->setStudentName($expected);

        $this->assertEquals($expected, $model->getStudentName());
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 4467;
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