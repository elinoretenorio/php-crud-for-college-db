<?php

declare(strict_types=1);

namespace College\Persons;

class PersonsService implements IPersonsService
{
    private IPersonsRepository $repository;

    public function __construct(IPersonsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PersonsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PersonsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $personId): ?PersonsModel
    {
        $dto = $this->repository->get($personId);
        if ($dto === null) {
            return null;
        }

        return new PersonsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PersonsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PersonsModel($dto);
        }

        return $result;
    }

    public function delete(int $personId): int
    {
        return $this->repository->delete($personId);
    }

    public function createModel(array $row): ?PersonsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PersonsDto($row);

        return new PersonsModel($dto);
    }
}