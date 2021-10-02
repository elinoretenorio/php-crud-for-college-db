<?php

declare(strict_types=1);

namespace College\Tests\Classrooms;

use PHPUnit\Framework\TestCase;
use College\Classrooms\{ ClassroomsDto, ClassroomsModel };

class ClassroomsModelTest extends TestCase
{
    private array $input;
    private ClassroomsDto $dto;
    private ClassroomsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "classroom_id" => 1328,
            "room_number" => 7484,
            "has_projector" => False,
            "building_id" => 3096,
        ];
        $this->dto = new ClassroomsDto($this->input);
        $this->model = new ClassroomsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ClassroomsModel(null);

        $this->assertInstanceOf(ClassroomsModel::class, $model);
    }

    public function testGetClassroomId(): void
    {
        $this->assertEquals($this->dto->classroomId, $this->model->getClassroomId());
    }

    public function testSetClassroomId(): void
    {
        $expected = 8862;
        $model = $this->model;
        $model->setClassroomId($expected);

        $this->assertEquals($expected, $model->getClassroomId());
    }

    public function testGetRoomNumber(): void
    {
        $this->assertEquals($this->dto->roomNumber, $this->model->getRoomNumber());
    }

    public function testSetRoomNumber(): void
    {
        $expected = 2046;
        $model = $this->model;
        $model->setRoomNumber($expected);

        $this->assertEquals($expected, $model->getRoomNumber());
    }

    public function testGetHasProjector(): void
    {
        $this->assertEquals($this->dto->hasProjector, $this->model->getHasProjector());
    }

    public function testSetHasProjector(): void
    {
        $expected = False;
        $model = $this->model;
        $model->setHasProjector($expected);

        $this->assertEquals($expected, $model->getHasProjector());
    }

    public function testGetBuildingId(): void
    {
        $this->assertEquals($this->dto->buildingId, $this->model->getBuildingId());
    }

    public function testSetBuildingId(): void
    {
        $expected = 7606;
        $model = $this->model;
        $model->setBuildingId($expected);

        $this->assertEquals($expected, $model->getBuildingId());
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