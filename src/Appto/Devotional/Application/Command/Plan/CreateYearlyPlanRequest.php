<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Common\Application\Command\Command;

class CreateYearlyPlanRequest implements Command
{
    private $id;
    private $year;
    private $title;
    private $coverPhotoUrl;

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
