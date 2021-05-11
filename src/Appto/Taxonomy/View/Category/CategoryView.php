<?php

declare(strict_types=1);

namespace Appto\Taxonomy\View\Category;

use Appto\Common\View\View;

/**
 * @author  Alfredo Melendres <alfredo.melendres@gmail.com>
 *
 * @OA\Schema(
 *     title="Category model",
 *     description="Category model",
 *     required={"id", "title"},
 *     @OA\Xml(
 *         name="category"
 *     )
 * )
 **/
class CategoryView implements View
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
     * @var string
     */
    public $description;

    /**
     * @OA\Property()
     * @var integer
     */
    public $position;

    public function __construct(string $id, string $title, string $description, int $position)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->position    = $position;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function position(): int
    {
        return $this->position;
    }
}
