<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Command\Plan\RemoveDailyDevotional;
use Appto\Devotional\Application\Command\Plan\RemoveDailyDevotionalRequest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/yearly-plans", name="yearlyplans_"
 * )
 */
class RemoveDailyDevotionalController
{
    /**
     * @Route(
     *     "/{id}/devotionals/{devotionalId}",
     *     methods={"DELETE"},
     *     name="RemoveDailyDevotional"
     * )
     *
     * @OA\Delete(
     *     path="/yearly-plans/{id}/devotionals/{devotionalId}",
     *     tags={"YearlyPlan"},
     *     summary="Remove DailyDevotional from YearlyPlan",
     *     description="Remove DailyDevotional from YearlyPlan",
     *     operationId="RemoveDailyDevotional",
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
     *      @OA\Parameter(
     *          name="devotionalId",
     *          in="path",
     *          description="DailyDevotional to delete",
     *          required=true,
     *              @OA\Schema(
     *                  type="string",
     *                  format="uuid"
     *              )
     *      ),
     *     @OA\Response(
     *          response=204,
     *          description="Success"
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found"
     *     ),
     *     @OA\Response(
     *          response=409,
     *          description="Conflict"
     *     )
     * )
     */
    public function removeDailyDevotional(
        string $id,
        string $devotionalId,
        RemoveDailyDevotional $removeDailyDevotional
    ) {
        $removeDailyDevotional(new RemoveDailyDevotionalRequest($id, $devotionalId));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
