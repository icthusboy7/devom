<?php

declare(strict_types=1);

namespace Appto\Common\Domain\DateTime;

use Appto\Common\Domain\Exception\InvalidArgumentException;

class InvalidYearlyDayException extends \DomainException implements InvalidArgumentException
{
    public function __construct(int $value)
    {
        parent::__construct(sprintf('Invalid yearly day <%s>', $value));
    }
}
