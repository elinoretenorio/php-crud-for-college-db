<?php

declare(strict_types=1);

namespace College\Tests\Buildings;

use PHPUnit\Framework\TestCase;
use College\Buildings\{ BuildingsDto, BuildingsModel };

class BuildingsModelTest extends TestCase
{
    private array $input;
    private BuildingsDto $dto;
    private BuildingsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "building_id" => 6962,
            "building_name" => "let",
            "college_name" => "stock",
        ];
        $this->dto = new BuildingsDto($this->input);
        $this->model = new BuildingsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new BuildingsModel(null);

        $this->assertInstanceOf(BuildingsModel::class, $model);
    }

    public function testGetBuildingId(): void
    {
        $this->assertEquals($this->dto->buildingId, $this->model->getBuildingId());
    }

    public function testSetBuildingId(): void
    {
        $expected = 1984;
        $model = $this->model;
        $model->setBuildingId($expected);

        $this->assertEquals($expected, $model->getBuildingId());
    }

    public function testGetBuildingName(): void
    {
        $this->assertEquals($this->dto->buildingName, $this->model->getBuildingName());
    }

    public function testSetBuildingName(): void
    {
        $expected = "last";
        $model = $this->model;
        $model->setBuildingName($expected);

        $this->assertEquals($expected, $model->getBuildingName());
    }

    public function testGetCollegeName(): void
    {
        $this->assertEquals($this->dto->collegeName, $this->model->getCollegeName());
    }

    public function testSetCollegeName(): void
    {
        $expected = "actually";
        $model = $this->model;
        $model->setCollegeName($expected);

        $this->assertEquals($expected, $model->getCollegeName());
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