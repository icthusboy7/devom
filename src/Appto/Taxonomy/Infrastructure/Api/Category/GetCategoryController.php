<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Infrastructure\Api\Category;

use Appto\Taxonomy\Application\Query\Category\GetCategory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Appto\Taxonomy\Application\Query\Category\GetCategoryRequest;

/**
 * @Route(
 *     "/categories", name="category_"
 * )
 */
class GetCategoryController
{
    /**
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="get_one"
     * )
     *
     * @OA\Get(
     *     path="/categories/{id}",
     *     tags={"Taxonomy"},
     *     summary="get Category",
     *     description="get category",
     *     operationId="getCategory",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of category to return",
     *          required=true,
     *              @OA\Schema(
     *                  type="string",
     *                  format="uuid"
     *              )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CategoryView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function getOne(string $id, GetCategory $getCategory)
    {
        return new JsonResponse($getCategory(new GetCategoryRequest($id)), Response::HTTP_OK);
    }
}
