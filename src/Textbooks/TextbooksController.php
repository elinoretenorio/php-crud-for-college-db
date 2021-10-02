<?php

declare(strict_types=1);

namespace College\Textbooks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TextbooksController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ITextbooksService $service;

    public function __construct(ITextbooksService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TextbooksModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $textbookId = (int) ($args["textbook_id"] ?? 0);
        if ($textbookId <= 0) {
            return new JsonResponse(["result" => $textbookId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TextbooksModel $model */
        $model = $this->service->createModel($data);
        $model->setTextbookId($textbookId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $textbookId = (int) ($args["textbook_id"] ?? 0);
        if ($textbookId <= 0) {
            return new JsonResponse(["result" => $textbookId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var TextbooksModel $model */
        $model = $this->service->get($textbookId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var TextbooksModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $textbookId = (int) ($args["textbook_id"] ?? 0);
        if ($textbookId <= 0) {
            return new JsonResponse(["result" => $textbookId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($textbookId);

        return new JsonResponse(["result" => $result]);
    }
}