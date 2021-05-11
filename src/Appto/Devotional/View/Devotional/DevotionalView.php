<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Devotional;

use Appto\Common\View\View;

/**
 * @author  Alfredo Melendres <alfredo.melendres@gmail.com>
 *
 * @OA\Schema(
 *     title="Devotional model",
 *     description="Devotional model",
 *     required={"id", "title", "content","authorId", "publisherId"},
 *     @OA\Xml(
 *         name="devotionalView"
 *     )
 * )
 **/
class DevotionalView implements View
{
    /**
     * @OA\Property(format="uuid")
     * @var string
     */
    public $id;

    /**
     * @OA\Property()
     * @var string
     */
    public $title;

    /**
     * @OA\Property()
     * @var PassageView
     */
    public $passage;

    /**
     * @OA\Property()
     * @var string
     */
    public $content;

    /**
     * @OA\Property()
     * @var null|string
     */
    public $bibleReading;

    /**
     * @OA\Property(format="url")
     * @var null|string
     */
    public $audioUrl;

    /**
     * @OA\Property(
     *     format="uuid",
     * )
     * @var string
     */
    public $authorId;

    /**
     * @OA\Property(
     *     format="uuid",
     * )
     * @var string
     */
    public $publisherId;

    /**
     * @OA\Property(
     *     type="array",
     *      @OA\Items(
     *          type="string",
     *          format="uuid"
     *      ),
     *      description="Topic Ids"
     * )
     * @var string[]
     */
    public $topics;

    /**
     * @OA\Property()
     * @var integer
     */
    public $status;

    public function __construct(
        string $id,
        string $title,
        PassageView $passage,
        string $content,
        ?string $bibleReading,
        ?string $audioUrl,
        array $topics,
        int $status,
        string $authorId,
        string $publisherId
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->passage = $passage;
        $this->content = $content;
        $this->bibleReading = $bibleReading;
        $this->audioUrl = $audioUrl;
        $this->authorId = $authorId;
        $this->publisherId = $publisherId;
        $this->topics = $topics;
        $this->status = $status;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function passage(): PassageView
    {
        return $this->passage;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function bibleReading(): ?string
    {
        return $this->bibleReading;
    }

    public function audioUrl(): ?string
    {
        return $this->audioUrl;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function publisherId(): string
    {
        return $this->publisherId;
    }

    public function topics(): array
    {
        return $this->topics;
    }

    public function status(): int
    {
        return $this->status;
    }
}
