<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Plan;

use Appto\Common\View\View;

/**
 * @author  Isaí Baca <isaionline@gmail.com>
 *
 * @OA\Schema(
 *     title="YearlyPlan model",
 *     description="YearlyPlan model",
 *     required={"id", "year", "title"},
 *     @OA\Xml(
 *         name="yearlyPlanView"
 *     )
 * )
 **/
class YearlyPlanView implements View
{
    /**
     * @OA\Property(format="uuid")
     * @var string
     */
    public $id;

    /**
     * @OA\Property(
     *     format="int",
     *     description="year > 0",
     *     title="year",
     * )
     * @var integer
     */
    public $year;

    /**
     * @OA\Property()
     * @var string
     */
    public $title;

    /**
     * @OA\Property(format="url")
     * @var null|string
     */
    public $coverPhotoUrl;

    public function __construct(
        string $id,
        int $year,
        string $title,
        ?string $coverPhotoUrl
    ) {
        $this->id = $id;
        $this->year = $year;
        $this->title = $title;
        $this->coverPhotoUrl = $coverPhotoUrl;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function year(): int
    {
        return $this->year;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function coverPhotoUrl(): ?string
    {
        return $this->coverPhotoUrl;
    }
}
