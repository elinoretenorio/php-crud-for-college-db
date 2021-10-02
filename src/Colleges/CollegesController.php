<?php

declare(strict_types=1);

namespace College\Colleges;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CollegesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICollegesService $service;

    public function __construct(ICollegesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CollegesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $collegeId = (int) ($args["college_id"] ?? 0);
        if ($collegeId <= 0) {
            return new JsonResponse(["result" => $collegeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CollegesModel $model */
        $model = $this->service->createModel($data);
        $model->setCollegeId($collegeId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $collegeId = (int) ($args["college_id"] ?? 0);
        if ($collegeId <= 0) {
            return new JsonResponse(["result" => $collegeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CollegesModel $model */
        $model = $this->service->get($collegeId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CollegesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $collegeId = (int) ($args["college_id"] ?? 0);
        if ($collegeId <= 0) {
            return new JsonResponse(["result" => $collegeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($collegeId);

        return new JsonResponse(["result" => $result]);
    }
}