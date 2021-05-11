<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Plan;

use Appto\Devotional\Application\Query\Plan\ListYearlyPlan;
use Appto\Devotional\Application\Query\Plan\ListYearlyPlanRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route(
 *     "/yearly-plans", name="yearly-plans_"
 * )
 */
class ListYearlyPlanController extends AbstractController
{
    /**
     * @Route(
     *     "",
     *     methods={"GET"},
     *     name="list"
     * )
     *
     * @OA\Get(
     *     path="/yearly-plans",
     *     tags={"YearlyPlan"},
     *     summary="List YearlyPlans",
     *     description="List YearlyPlans",
     *     operationId="listYearlyPlan",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/YearlyPlanView")
     *         )
     *     )
     * )
     */
    public function list(ListYearlyPlan $listYearlyPlan)
    {
        return new JsonResponse($listYearlyPlan(new ListYearlyPlanRequest()), Response::HTTP_OK);
    }
}
