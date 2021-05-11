<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\Query;

class GetDailyDevotionalRequest implements Query
{
    private $planId;
    private $devotionalId;

    public function __construct(string $planId, string $devotionalId)
    {
        $this->planId = $planId;
        $this->devotionalId = $devotionalId;
    }

    public function planId(): string
    {
        return $this->planId;
    }

    public function devotionalId(): string
    {
        return $this->devotionalId;
    }
}
