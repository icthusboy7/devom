<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Devotional;

use Appto\Devotional\Application\Query\Devotional\GetDevotional;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Appto\Devotional\Application\Query\Devotional\GetDevotionalRequest;

/**
 * @Route(
 *     "/devotionals", name="devotional_"
 * )
 */
class GetDevotionalController extends AbstractController
{
    /**
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="get"
     * )
     *
     * @OA\Get(
     *     path="/devotionals/{id}",
     *     tags={"Devotional"},
     *     summary="Get Devotional",
     *     description="Get devotional",
     *     operationId="getDevotional",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of yearly plan to return",
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
     *             @OA\Items(ref="#/components/schemas/DevotionalView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function __invoke(string $id, GetDevotional $getDevotional)
    {
        return new JsonResponse($getDevotional(new GetDevotionalRequest($id)), Response::HTTP_OK);
    }
}
