<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Plan;

use Appto\Common\View\View;
use Appto\Devotional\View\Devotional\DevotionalView;

/**
 * @author  Isaí Baca <isaionline@gmail.com>
 *
 * @OA\Schema(
 *     title="DailyDevotional model",
 *     description="DailyDevotional model",
 *     required={"devotionalId", "day"},
 *     @OA\Xml(
 *         name="DailyDevotionalView"
 *     )
 * )
 **/
class DailyDevotionalView implements View
{
    /**
     * @OA\Property()
     * @var DevotionalView
     */
    public $devotional;

    /**
     * @OA\Property()
     * @var integer
     */
    public $day;

    public function __construct(
        DevotionalView $devotional,
        int $day
    ) {
        $this->devotional = $devotional;
        $this->day = $day;
    }

    public function devotional(): DevotionalView
    {
        return $this->devotional;
    }

    public function day(): int
    {
        return $this->day;
    }
}
