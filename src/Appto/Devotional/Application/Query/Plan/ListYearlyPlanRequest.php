<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\Query;

class ListYearlyPlanRequest implements Query
{
    private ?string $devotionalId;

    public function __construct(?string $devotionalId = null)
    {
        $this->devotionalId = $devotionalId;
    }

    public function devotionalId(): ?string
    {
        return $this->devotionalId;
    }
}
