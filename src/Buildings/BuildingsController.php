<?php

declare(strict_types=1);

namespace College\Buildings;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class BuildingsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IBuildingsService $service;

    public function __construct(IBuildingsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var BuildingsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $buildingId = (int) ($args["building_id"] ?? 0);
        if ($buildingId <= 0) {
            return new JsonResponse(["result" => $buildingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var BuildingsModel $model */
        $model = $this->service->createModel($data);
        $model->setBuildingId($buildingId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $buildingId = (int) ($args["building_id"] ?? 0);
        if ($buildingId <= 0) {
            return new JsonResponse(["result" => $buildingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var BuildingsModel $model */
        $model = $this->service->get($buildingId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var BuildingsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $buildingId = (int) ($args["building_id"] ?? 0);
        if ($buildingId <= 0) {
            return new JsonResponse(["result" => $buildingId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($buildingId);

        return new JsonResponse(["result" => $result]);
    }
}