<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Api\Devotional;

use Appto\Devotional\Application\Command\Devotional\CreateDevotional;
use Appto\Devotional\Application\Command\Devotional\CreateDevotionalRequest;
use Appto\Devotional\View\Devotional\PassageView;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/devotionals", name="devotional_"
 * )
 */
class CreateDevotionalController
{
    /**
     * @Route(
     *     "",
     *     methods={"POST"},
     *     name="create"
     * )
     *
     * @OA\Post(
     *     path="/devotionals",
     *     tags={"Devotional"},
     *     summary="Create Devotional",
     *     description="Create devotional",
     *     operationId="addDevotional",
     *     @OA\RequestBody(
     *          request="Devotional",
     *          description="Devotional object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/DevotionalView")
     *      ),
     *     @OA\Response(
     *          response=201,
     *          description="Created"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad request"
     *     ),
     *     @OA\Response(
     *          response=409,
     *          description="Conflict"
     *     )
     * )
     */
    public function __invoke(Request $request, CreateDevotional $createDevotional)
    {
        $body = json_decode((string)$request->getContent());

        if (
            empty($body->id) || !is_string($body->id)
            || empty($body->title) || !is_string($body->title)
            || empty($body->content) || !is_string($body->title)
            || empty($body->authorId) || !is_string($body->authorId)
            || empty($body->publisherId) || !is_string($body->publisherId)
            || (isset($body->topics) && !is_array($body->topics))
        ) {
            throw new BadRequestHttpException("Bad request");
        }

        $createDevotional(new CreateDevotionalRequest(
            $body->id,
            $body->title,
            $body->content,
            isset($body->bibleReading) ? $body->bibleReading : null,
            isset($body->audioUrl) ? $body->audioUrl : null,
            $body->authorId,
            $body->publisherId,
            isset($body->passage)
                ? new PassageView($body->passage->text, $body->passage->reference)
                : null,
            isset($body->topics) ? $body->topics : null
        ));

        return new Response(null, Response::HTTP_CREATED);
    }
}
