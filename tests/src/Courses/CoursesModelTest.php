<?php

declare(strict_types=1);

namespace College\Tests\Courses;

use PHPUnit\Framework\TestCase;
use College\Courses\{ CoursesDto, CoursesModel };

class CoursesModelTest extends TestCase
{
    private array $input;
    private CoursesDto $dto;
    private CoursesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "course_id" => 4623,
            "course_name" => "school",
            "textbook_isbn" => 6643,
        ];
        $this->dto = new CoursesDto($this->input);
        $this->model = new CoursesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CoursesModel(null);

        $this->assertInstanceOf(CoursesModel::class, $model);
    }

    public function testGetCourseId(): void
    {
        $this->assertEquals($this->dto->courseId, $this->model->getCourseId());
    }

    public function testSetCourseId(): void
    {
        $expected = 1059;
        $model = $this->model;
        $model->setCourseId($expected);

        $this->assertEquals($expected, $model->getCourseId());
    }

    public function testGetCourseName(): void
    {
        $this->assertEquals($this->dto->courseName, $this->model->getCourseName());
    }

    public function testSetCourseName(): void
    {
        $expected = "fish";
        $model = $this->model;
        $model->setCourseName($expected);

        $this->assertEquals($expected, $model->getCourseName());
    }

    public function testGetTextbookIsbn(): void
    {
        $this->assertEquals($this->dto->textbookIsbn, $this->model->getTextbookIsbn());
    }

    public function testSetTextbookIsbn(): void
    {
        $expected = 9173;
        $model = $this->model;
        $model->setTextbookIsbn($expected);

        $this->assertEquals($expected, $model->getTextbookIsbn());
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