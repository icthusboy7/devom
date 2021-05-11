<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Infrastructure\Api\Category;

use Appto\Taxonomy\Application\Command\Category\CreateCategory;
use Appto\Taxonomy\Application\Command\Category\CreateCategoryRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route(
 *     "/categories", name="category_"
 * )
 */
class CreateCategoryController
{
    /**
     * @Route(
     *     "",
     *     methods={"POST"},
     *     name="create"
     * )
     *
     * @OA\Post(
     *     path="/categories",
     *     tags={"Taxonomy"},
     *     summary="Create Category",
     *     description="Create Category",
     *     operationId="addCategory",
     *     @OA\RequestBody(
     *          request="Category",
     *          description="Category object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CategoryView")
     *      ),
     *     @OA\Response(
     *          response=201,
     *          description="Created"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad request"
     *     ),
     *     @OA\Response(
     *          response=409,
     *          description="Conflict"
     *     )
     * )
     */
    public function __invoke(Request $request, CreateCategory $createCategory)
    {
        $body = json_decode((string)$request->getContent());

        $createCategory(new CreateCategoryRequest(
            $body->id,
            $body->title,
            $body->description ?? null,
            $body->position ?? 0
        ));

        return new Response(null, Response::HTTP_CREATED);
    }
}
