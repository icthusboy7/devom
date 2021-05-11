<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Devotional;

use Appto\Common\View\View;

/**
 * @author  Alfredo Melendres <alfredo.melendres@gmail.com>
 *
 * @OA\Schema(
 *     title="Devotional Passage Model",
 *     description="Devotional passage model",
 *     required={"text", "reference"},
 *     @OA\Xml(
 *         name="PassageView"
 *     )
 * )
 **/
class PassageView implements View
{
    /**
     * @OA\Property()
     * @var string
     */
    public $text;

    /**
     * @OA\Property()
     * @var string
     */
    public $reference;

    public function __construct(
        string $text,
        string $reference
    ) {
        $this->text = $text;
        $this->reference = $reference;
    }
}
