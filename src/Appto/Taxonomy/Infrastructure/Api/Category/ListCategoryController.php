<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Infrastructure\Api\Category;

use Appto\Taxonomy\Domain\Category\Category;
use Appto\Taxonomy\Domain\Category\CategoryRepository;
use Appto\Taxonomy\View\Category\CategoryView;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route(
 *     "/categories", name="category_"
 * )
 */
class ListCategoryController
{
    /**
     * @Route(
     *     "",
     *     methods={"GET"},
     *     name="list"
     * )
     *
     * @OA\Get(
     *     path="/categories",
     *     tags={"Taxonomy"},
     *     summary="List Category",
     *     description="List category",
     *     operationId="listCategory",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CategoryView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function list(CategoryRepository $categoryRepository)
    {
        return new JsonResponse(
            array_map(function (Category $category) {
                return new CategoryView(
                    $category->id()->value(),
                    $category->title()->value(),
                    $category->description(),
                    $category->position()->value(),
                );
            },
            $categoryRepository->all()),
            Response::HTTP_OK
        );
    }
}
