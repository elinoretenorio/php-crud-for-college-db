<?php

declare(strict_types=1);

namespace College\Sections;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class SectionsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ISectionsService $service;

    public function __construct(ISectionsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SectionsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $sectionId = (int) ($args["section_id"] ?? 0);
        if ($sectionId <= 0) {
            return new JsonResponse(["result" => $sectionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var SectionsModel $model */
        $model = $this->service->createModel($data);
        $model->setSectionId($sectionId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $sectionId = (int) ($args["section_id"] ?? 0);
        if ($sectionId <= 0) {
            return new JsonResponse(["result" => $sectionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var SectionsModel $model */
        $model = $this->service->get($sectionId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var SectionsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $sectionId = (int) ($args["section_id"] ?? 0);
        if ($sectionId <= 0) {
            return new JsonResponse(["result" => $sectionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($sectionId);

        return new JsonResponse(["result" => $result]);
    }
}