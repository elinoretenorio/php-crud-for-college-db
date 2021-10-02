<?php

declare(strict_types=1);

namespace College\Courses;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CoursesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICoursesService $service;

    public function __construct(ICoursesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CoursesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $courseId = (int) ($args["course_id"] ?? 0);
        if ($courseId <= 0) {
            return new JsonResponse(["result" => $courseId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CoursesModel $model */
        $model = $this->service->createModel($data);
        $model->setCourseId($courseId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $courseId = (int) ($args["course_id"] ?? 0);
        if ($courseId <= 0) {
            return new JsonResponse(["result" => $courseId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CoursesModel $model */
        $model = $this->service->get($courseId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CoursesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $courseId = (int) ($args["course_id"] ?? 0);
        if ($courseId <= 0) {
            return new JsonResponse(["result" => $courseId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($courseId);

        return new JsonResponse(["result" => $result]);
    }
}