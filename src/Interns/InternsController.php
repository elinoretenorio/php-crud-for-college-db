<?php

declare(strict_types=1);

namespace College\Interns;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class InternsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IInternsService $service;

    public function __construct(IInternsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var InternsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $internId = (int) ($args["intern_id"] ?? 0);
        if ($internId <= 0) {
            return new JsonResponse(["result" => $internId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var InternsModel $model */
        $model = $this->service->createModel($data);
        $model->setInternId($internId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $internId = (int) ($args["intern_id"] ?? 0);
        if ($internId <= 0) {
            return new JsonResponse(["result" => $internId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var InternsModel $model */
        $model = $this->service->get($internId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var InternsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $internId = (int) ($args["intern_id"] ?? 0);
        if ($internId <= 0) {
            return new JsonResponse(["result" => $internId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($internId);

        return new JsonResponse(["result" => $result]);
    }
}