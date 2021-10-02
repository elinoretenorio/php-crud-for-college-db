<?php

declare(strict_types=1);

namespace College\Faculties;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class FacultiesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IFacultiesService $service;

    public function __construct(IFacultiesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var FacultiesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $facultyId = (int) ($args["faculty_id"] ?? 0);
        if ($facultyId <= 0) {
            return new JsonResponse(["result" => $facultyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var FacultiesModel $model */
        $model = $this->service->createModel($data);
        $model->setFacultyId($facultyId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $facultyId = (int) ($args["faculty_id"] ?? 0);
        if ($facultyId <= 0) {
            return new JsonResponse(["result" => $facultyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var FacultiesModel $model */
        $model = $this->service->get($facultyId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var FacultiesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $facultyId = (int) ($args["faculty_id"] ?? 0);
        if ($facultyId <= 0) {
            return new JsonResponse(["result" => $facultyId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($facultyId);

        return new JsonResponse(["result" => $result]);
    }
}