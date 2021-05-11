<?php

declare(strict_types=1);

namespace Appto\Common\Domain\Url;

use Appto\Common\Domain\Exception\InvalidArgumentException;

class InvalidUrlException extends \DomainException implements InvalidArgumentException
{
    public function __construct(string $value)
    {
        parent::__construct("Invalid Url <$value>");
    }
}
