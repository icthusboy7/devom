<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Query\Plan\GetDailyDevotional;
use Appto\Devotional\Application\Query\Plan\GetDailyDevotionalRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route(
 *     "/yearly-plans", name="yearly-plans_"
 * )
 */
class GetDailyDevotionalController
{
    /**
     * @Route(
     *     "/{id}/devotionals/{devotionalId}",
     *     methods={"GET"},
     *     name="get_daily_devotional"
     * )
     *
     * @OA\Get(
     *     path="/yearly-plans/{id}/devotionals/{devotionalId}",
     *     tags={"YearlyPlan"},
     *     summary="Get Daily Devotional",
     *     description="Get Daily Devotional",
     *     operationId="GetDailyDevotional",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of yearly plan",
     *          required=true,
     *              @OA\Schema(
     *                  type="string",
     *                  format="uuid"
     *              )
     *      ),
     *      @OA\Parameter(
     *          name="devotionalId",
     *          in="path",
     *          description="ID of devotional",
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
     *             @OA\Items(ref="#/components/schemas/DailyDevotionalView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="NOT FOUND"
     *     )
     * )
     */
    public function __invoke(string $id, string $devotionalId, GetDailyDevotional $getDailyDevotional)
    {
        return new JsonResponse(
            $getDailyDevotional(new GetDailyDevotionalRequest($id, $devotionalId)),
            Response::HTTP_OK
        );
    }
}
