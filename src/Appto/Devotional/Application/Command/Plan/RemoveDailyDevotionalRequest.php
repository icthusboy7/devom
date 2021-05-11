<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Common\Application\Command\Command;

class RemoveDailyDevotionalRequest implements Command
{
    private $planId;
    private $devotionalId;

    public function __construct(
        string $planId,
        string $devotionalId
    ) {
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
