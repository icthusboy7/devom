<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Query\Plan\ListYearlyPlan;
use Appto\Devotional\Application\Query\Plan\ListYearlyPlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route(
 *     "/yearly-plans", name="yearly-plans_"
 * )
 */
class ExistsInYearlyPlanController
{
    /**
     * @Route(
     *     "",
     *     methods={"HEAD"},
     *     name="exists"
     * )
     *
     * @OA\Head(
     *     path="/yearly-plans",
     *     tags={"YearlyPlan"},
     *     summary="Devotional exists in Yearly Plans",
     *     description="Check if devotional exists in yearly plans",
     *     operationId="existsYearlyPlan",
     *      @OA\Parameter(
     *          name="devotionalId",
     *          in="query",
     *          description="Devotional ID to Find",
     *          required=true,
     *              @OA\Schema(
     *                  type="string",
     *                  format="uuid"
     *              )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Exists"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Not Exists"
     *     )
     * )
     */
    public function __invoke(Request $request, ListYearlyPlan $listYearlyPlan)
    {
        $devotionalId = $request->query->get('devotionalId');
        $yearlyPlans = $listYearlyPlan(new ListYearlyPlanRequest($devotionalId));

        if ($yearlyPlans) {
            return new JsonResponse(null, Response::HTTP_OK);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
