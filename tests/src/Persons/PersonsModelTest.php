<?php

declare(strict_types=1);

namespace College\Tests\Persons;

use PHPUnit\Framework\TestCase;
use College\Persons\{ PersonsDto, PersonsModel };

class PersonsModelTest extends TestCase
{
    private array $input;
    private PersonsDto $dto;
    private PersonsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "person_id" => 6710,
            "person_phone_number" => "teacher",
            "person_name" => "standard",
        ];
        $this->dto = new PersonsDto($this->input);
        $this->model = new PersonsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PersonsModel(null);

        $this->assertInstanceOf(PersonsModel::class, $model);
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 2416;
        $model = $this->model;
        $model->setPersonId($expected);

        $this->assertEquals($expected, $model->getPersonId());
    }

    public function testGetPersonPhoneNumber(): void
    {
        $this->assertEquals($this->dto->personPhoneNumber, $this->model->getPersonPhoneNumber());
    }

    public function testSetPersonPhoneNumber(): void
    {
        $expected = "within";
        $model = $this->model;
        $model->setPersonPhoneNumber($expected);

        $this->assertEquals($expected, $model->getPersonPhoneNumber());
    }

    public function testGetPersonName(): void
    {
        $this->assertEquals($this->dto->personName, $this->model->getPersonName());
    }

    public function testSetPersonName(): void
    {
        $expected = "PM";
        $model = $this->model;
        $model->setPersonName($expected);

        $this->assertEquals($expected, $model->getPersonName());
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