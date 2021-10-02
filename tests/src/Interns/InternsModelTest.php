<?php

declare(strict_types=1);

namespace College\Tests\Interns;

use PHPUnit\Framework\TestCase;
use College\Interns\{ InternsDto, InternsModel };

class InternsModelTest extends TestCase
{
    private array $input;
    private InternsDto $dto;
    private InternsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "intern_id" => 8712,
            "person_id" => 1413,
            "intern_hourly_wage" => 234.60,
        ];
        $this->dto = new InternsDto($this->input);
        $this->model = new InternsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new InternsModel(null);

        $this->assertInstanceOf(InternsModel::class, $model);
    }

    public function testGetInternId(): void
    {
        $this->assertEquals($this->dto->internId, $this->model->getInternId());
    }

    public function testSetInternId(): void
    {
        $expected = 3643;
        $model = $this->model;
        $model->setInternId($expected);

        $this->assertEquals($expected, $model->getInternId());
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 5291;
        $model = $this->model;
        $model->setPersonId($expected);

        $this->assertEquals($expected, $model->getPersonId());
    }

    public function testGetInternHourlyWage(): void
    {
        $this->assertEquals($this->dto->internHourlyWage, $this->model->getInternHourlyWage());
    }

    public function testSetInternHourlyWage(): void
    {
        $expected = 822.00;
        $model = $this->model;
        $model->setInternHourlyWage($expected);

        $this->assertEquals($expected, $model->getInternHourlyWage());
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