<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Devotional;

use Appto\Devotional\Application\Command\Devotional\RemoveDevotional;
use Appto\Devotional\Application\Command\Devotional\RemoveDevotionalRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/devotionals", name="devotional_"
 * )
 */
class RemoveDevotionalController extends AbstractController
{
    /**
     * @Route(
     *     "/{id}",
     *     methods={"DELETE"},
     *     name="RemoveDevotional"
     * )
     *
     * @OA\Delete(
     *     path="/devotionals/{id}",
     *     tags={"Devotional"},
     *     summary="Remove Devotional",
     *     description="Remove Devotional",
     *     operationId="RemoveDevotional",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of Devotional",
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
     *          response=400,
     *          description="Bad Request"
     *     ),
     *     @OA\Response(
     *          response=409,
     *          description="Conflict - You cannot delete a devotional used in a plan"
     *     )
     * )
     */
    public function remove(string $id, RemoveDevotional $removeDevotional)
    {
        $removeDevotional(new RemoveDevotionalRequest($id));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
