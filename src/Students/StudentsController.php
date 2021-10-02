<?php

declare(strict_types=1);

namespace College\Students;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class StudentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IStudentsService $service;

    public function __construct(IStudentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var StudentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $studentId = (int) ($args["student_id"] ?? 0);
        if ($studentId <= 0) {
            return new JsonResponse(["result" => $studentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var StudentsModel $model */
        $model = $this->service->createModel($data);
        $model->setStudentId($studentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $studentId = (int) ($args["student_id"] ?? 0);
        if ($studentId <= 0) {
            return new JsonResponse(["result" => $studentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var StudentsModel $model */
        $model = $this->service->get($studentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var StudentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $studentId = (int) ($args["student_id"] ?? 0);
        if ($studentId <= 0) {
            return new JsonResponse(["result" => $studentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($studentId);

        return new JsonResponse(["result" => $result]);
    }
}