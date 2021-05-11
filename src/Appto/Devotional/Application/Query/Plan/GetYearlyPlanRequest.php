<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\Query;

class GetYearlyPlanRequest implements Query
{
    private $planId;

    public function __construct(string $planId)
    {
        $this->planId = $planId;
    }

    public function planId(): string
    {
        return $this->planId;
    }
}
