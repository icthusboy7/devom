<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Query\Plan\GetYearlyPlan;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Appto\Devotional\Application\Query\Plan\GetYearlyPlanRequest;

/**
 * @Route(
 *     "/yearly-plans", name="yearly-plans_"
 * )
 */
class GetYearlyPlanController
{
    /**
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="get"
     * )
     *
     * @OA\Get(
     *     path="/yearly-plans/{id}",
     *     tags={"YearlyPlan"},
     *     summary="YearlyPlan",
     *     description="Get YearlyPlan",
     *     operationId="getYearlyPlan",
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
     *             @OA\Items(ref="#/components/schemas/YearlyPlanView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="NOT FOUND"
     *     )
     * )
     */
    public function __invoke(string $id, GetYearlyPlan $getYearlyPlan)
    {
        return new JsonResponse($getYearlyPlan(new GetYearlyPlanRequest($id)), Response::HTTP_OK);
    }
}
