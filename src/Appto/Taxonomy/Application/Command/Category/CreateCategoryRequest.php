<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Application\Command\Category;

use Appto\Common\Application\Command\Command;

class CreateCategoryRequest implements Command
{
    private $id;
    private $title;
    private $description;
    private $position;

    public function __construct(string $id, string $title, ?string $description = null, int $position = 0)
    {
        $this->id  = $id;
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

    public function description(): ?string
    {
        return $this->description;
    }

    public function position(): int
    {
        return $this->position;
    }
}
