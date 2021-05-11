<?php

namespace Appto\Common\Domain\DateTime;

use Appto\Common\Domain\Exception\InvalidArgumentException;

class InvalidYearException extends \DomainException implements InvalidArgumentException
{
    public function __construct(int $value)
    {
        parent::__construct("Invalid year <$value>");
    }
}
