<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\Exception\NotFoundException;

class DailyDevotionalNotFoundException extends \DomainException implements NotFoundException
{
    public function __construct(string $devotionalId)
    {
        parent::__construct(sprintf('Daily devotional <%s> not found', $devotionalId));
    }
}
