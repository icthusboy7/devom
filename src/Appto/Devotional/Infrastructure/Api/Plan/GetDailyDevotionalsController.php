<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Query\Plan\GetDailyDevotionals;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Appto\Devotional\Application\Query\Plan\GetDailyDevotionalsRequest;

/**
 * @Route(
 *     "/yearly-plans", name="yearly-plans_"
 * )
 */
class GetDailyDevotionalsController
{
    /**
     * @Route(
     *     "/{id}/devotionals",
     *     methods={"GET"},
     *     name="get_yearly_plan_daily_devotionals"
     * )
     *
     * @OA\Get(
     *     path="/yearly-plans/{id}/devotionals",
     *     tags={"YearlyPlan"},
     *     summary="YearlyPlan Daily Devotionals",
     *     description="Get YearlyPlan Daily Devotionals",
     *     operationId="getYearlyPlanDailyDevotionals",
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
     *             @OA\Items(ref="#/components/schemas/DailyDevotionalView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="NOT FOUND"
     *     )
     * )
     */
    public function __invoke(string $id, GetDailyDevotionals $getDailyDevotionals)
    {
        return new JsonResponse($getDailyDevotionals(new GetDailyDevotionalsRequest($id)), Response::HTTP_OK);
    }
}
