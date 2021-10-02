<?php

declare(strict_types=1);

namespace College\Tests\Colleges;

use PHPUnit\Framework\TestCase;
use College\Colleges\{ CollegesDto, CollegesModel };

class CollegesModelTest extends TestCase
{
    private array $input;
    private CollegesDto $dto;
    private CollegesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "college_id" => 1353,
            "college_name" => "system",
            "college_total_students" => 5269,
        ];
        $this->dto = new CollegesDto($this->input);
        $this->model = new CollegesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CollegesModel(null);

        $this->assertInstanceOf(CollegesModel::class, $model);
    }

    public function testGetCollegeId(): void
    {
        $this->assertEquals($this->dto->collegeId, $this->model->getCollegeId());
    }

    public function testSetCollegeId(): void
    {
        $expected = 62;
        $model = $this->model;
        $model->setCollegeId($expected);

        $this->assertEquals($expected, $model->getCollegeId());
    }

    public function testGetCollegeName(): void
    {
        $this->assertEquals($this->dto->collegeName, $this->model->getCollegeName());
    }

    public function testSetCollegeName(): void
    {
        $expected = "however";
        $model = $this->model;
        $model->setCollegeName($expected);

        $this->assertEquals($expected, $model->getCollegeName());
    }

    public function testGetCollegeTotalStudents(): void
    {
        $this->assertEquals($this->dto->collegeTotalStudents, $this->model->getCollegeTotalStudents());
    }

    public function testSetCollegeTotalStudents(): void
    {
        $expected = 3331;
        $model = $this->model;
        $model->setCollegeTotalStudents($expected);

        $this->assertEquals($expected, $model->getCollegeTotalStudents());
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