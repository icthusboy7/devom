<?php

namespace Appto\Devotional\View\Devotional;

use Appto\Common\View\View;

/**
 * @author  Alfredo Melendres <alfredo.melendres@gmail.com>
 *
 * @OA\Schema(
 *     title="Topic model",
 *     description="Topic model",
 *     @OA\Xml(
 *         name="Topic"
 *     )
 * )
 **/
class TopicView implements View
{
    /**
     * @OA\Property(format="uuid")
     * @var string
     */
    public $id;

    /**
     * @OA\Property(format="uuid")
     * @var string
     */
    public $title;

    public function __construct(
        string $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }
}
