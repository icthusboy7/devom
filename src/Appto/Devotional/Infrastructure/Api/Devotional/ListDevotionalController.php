<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Devotional;

use Appto\Devotional\View\Devotional\DevotionalViewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route(
 *     "/devotionals", name="devotional_"
 * )
 */
class ListDevotionalController extends AbstractController
{
    /**
     * @Route(
     *     "",
     *     methods={"GET"},
     *     name="list"
     * )
     *
     * @OA\Get(
     *     path="/devotionals",
     *     tags={"Devotional"},
     *     summary="List Devotional",
     *     description="List devotional",
     *     operationId="listDevotional",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/DevotionalView")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function list(DevotionalViewRepository $devotionalViewRepository)
    {
        return new JsonResponse($devotionalViewRepository->all(), Response::HTTP_OK);
    }
}
