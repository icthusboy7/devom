<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Common\Application\Command\Command;

class AddDailyDevotionalRequest implements Command
{
    private $planId;
    private $devotionalId;
    private $day;

    public function __construct(
        string $planId,
        string $devotionalId,
        int $day
    ) {
        $this->planId = $planId;
        $this->devotionalId = $devotionalId;
        $this->day = $day;
    }

    public function planId(): string
    {
        return $this->planId;
    }

    public function devotionalId(): string
    {
        return $this->devotionalId;
    }

    public function day(): int
    {
        return $this->day;
    }
}
