<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Common\Application\Command\Command;

class RemoveYearlyPlanRequest implements Command
{
    private $planId;

    public function __construct(
        string $planId
    ) {
        $this->planId = $planId;
    }

    public function planId(): string
    {
        return $this->planId;
    }
}
