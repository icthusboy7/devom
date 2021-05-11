<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan\Exception;

use Appto\Common\Domain\DateTime\YearlyDay;

class InvalidDevotionalDayException extends \DomainException
{
    public function __construct(YearlyDay $day)
    {
        parent::__construct(sprintf('Does not valid day <%s>', $day->value()));
    }
}
