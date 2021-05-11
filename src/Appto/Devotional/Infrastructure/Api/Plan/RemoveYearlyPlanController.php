<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Command\Plan\RemoveYearlyPlan;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Appto\Devotional\Application\Command\Plan\RemoveYearlyPlanRequest;

/**
 * @Route(
 *     "/yearly-plans", name="yearlyplans_"
 * )
 */
class RemoveYearlyPlanController
{
    /**
     * @Route(
     *     "/{id}",
     *     methods={"DELETE"},
     *     name="RemoveYearlyPlan"
     * )
     *
     * @OA\Delete(
     *     path="/yearly-plans/{id}",
     *     tags={"YearlyPlan"},
     *     summary="Remove YearlyPlan",
     *     description="Remove YearlyPlan",
     *     operationId="RemoveYearlyPlan",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of Plan",
     *          required=true,
     *              @OA\Schema(
     *                  type="string",
     *                  format="uuid"
     *              )
     *      ),
     *     @OA\Response(
     *          response=204,
     *          description="No Content"
     *     )
     * )
     */
    public function remove(string $id, RemoveYearlyPlan $removeYearlyPlan)
    {
        $removeYearlyPlan(new RemoveYearlyPlanRequest($id));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
