<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Command\Plan\AddDailyDevotional;
use Appto\Devotional\Application\Command\Plan\AddDailyDevotionalRequest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/yearly-plans", name="yearlyplans_"
 * )
 */
class AddDailyDevotionalController
{
    /**
     * @Route(
     *     "/{id}/devotionals",
     *     methods={"POST"},
     *     name="add"
     * )
     *
     * @OA\Post(
     *     path="/yearly-plans/{id}/devotionals",
     *     tags={"YearlyPlan"},
     *     summary="Add DailyDevotional to YearlyPlan",
     *     description="Add DailyDevotional to YearlyPlan",
     *     operationId="AddDailyDevotional",
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
     *    @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="devotionalId",
     *                     type="uuid"
     *                 ),
     *                 @OA\Property(
     *                     property="day",
     *                     type="integer"
     *                 ),
     *                 example={"devotionalId": "848de040-95ef-4636-9cc6-c2b3d7beaf55", "day": 1}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="Success"
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found"
     *     ),
     *     @OA\Response(
     *          response=409,
     *          description="Conflict"
     *     )
     * )
     */
    public function __invoke(Request $request, string $id, AddDailyDevotional $addDailyDevotional)
    {
        $body = json_decode((string)$request->getContent());

        $addDailyDevotional(new AddDailyDevotionalRequest(
            $id,
            $body->devotionalId,
            $body->day
        ));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
