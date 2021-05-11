<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Command\Plan\CreateYearlyPlan;
use Appto\Devotional\Application\Command\Plan\CreateYearlyPlanRequest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/yearly-plans", name="yearlyplan_"
 * )
 */
class CreateYearlyPlanController
{
    /**
     * @Route(
     *     "",
     *     methods={"POST"},
     *     name="create"
     * )
     *
     * @OA\Post(
     *     path="/yearly-plans",
     *     tags={"YearlyPlan"},
     *     summary="Create YearlyPlan",
     *     description="Create YearlyPlan",
     *     operationId="CreateYearlyPlan",
     *     @OA\RequestBody(
     *          request="YearlyPlan",
     *          description="YearlyPlan object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/YearlyPlanView")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Conflict"
     *     )
     * )
     */
    public function __invoke(Request $request, CreateYearlyPlan $createYearlyPlan)
    {
        $body = json_decode((string)$request->getContent());
        $createYearlyPlan(new CreateYearlyPlanRequest(
            $body->id,
            $body->year,
            $body->title,
            $body->coverPhotoUrl
        ));

        return new Response(null, Response::HTTP_CREATED);
    }
}
