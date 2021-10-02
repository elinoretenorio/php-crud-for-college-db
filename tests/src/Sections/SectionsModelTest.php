<?php

declare(strict_types=1);

namespace College\Tests\Sections;

use PHPUnit\Framework\TestCase;
use College\Sections\{ SectionsDto, SectionsModel };

class SectionsModelTest extends TestCase
{
    private array $input;
    private SectionsDto $dto;
    private SectionsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "section_id" => 215,
            "section_date" => "2021-10-14",
            "room_number" => 4976,
            "course_id" => 93,
            "building_id" => 3231,
            "person_id" => 8647,
        ];
        $this->dto = new SectionsDto($this->input);
        $this->model = new SectionsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new SectionsModel(null);

        $this->assertInstanceOf(SectionsModel::class, $model);
    }

    public function testGetSectionId(): void
    {
        $this->assertEquals($this->dto->sectionId, $this->model->getSectionId());
    }

    public function testSetSectionId(): void
    {
        $expected = 8206;
        $model = $this->model;
        $model->setSectionId($expected);

        $this->assertEquals($expected, $model->getSectionId());
    }

    public function testGetSectionDate(): void
    {
        $this->assertEquals($this->dto->sectionDate, $this->model->getSectionDate());
    }

    public function testSetSectionDate(): void
    {
        $expected = "2021-10-13";
        $model = $this->model;
        $model->setSectionDate($expected);

        $this->assertEquals($expected, $model->getSectionDate());
    }

    public function testGetRoomNumber(): void
    {
        $this->assertEquals($this->dto->roomNumber, $this->model->getRoomNumber());
    }

    public function testSetRoomNumber(): void
    {
        $expected = 1284;
        $model = $this->model;
        $model->setRoomNumber($expected);

        $this->assertEquals($expected, $model->getRoomNumber());
    }

    public function testGetCourseId(): void
    {
        $this->assertEquals($this->dto->courseId, $this->model->getCourseId());
    }

    public function testSetCourseId(): void
    {
        $expected = 6781;
        $model = $this->model;
        $model->setCourseId($expected);

        $this->assertEquals($expected, $model->getCourseId());
    }

    public function testGetBuildingId(): void
    {
        $this->assertEquals($this->dto->buildingId, $this->model->getBuildingId());
    }

    public function testSetBuildingId(): void
    {
        $expected = 6222;
        $model = $this->model;
        $model->setBuildingId($expected);

        $this->assertEquals($expected, $model->getBuildingId());
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 2931;
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