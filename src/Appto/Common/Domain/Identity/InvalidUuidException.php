<?php

declare(strict_types=1);

namespace Appto\Common\Domain\Identity;

use Appto\Common\Domain\Exception\InvalidArgumentException;

class InvalidUuidException extends \DomainException implements InvalidArgumentException
{
    public function __construct(string $value)
    {
        parent::__construct(sprintf('Invalid Uuid <%s>', $value));
    }
}
