<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\Exception\InvalidArgumentException;

class InvalidContentException extends \DomainException implements InvalidArgumentException
{
    public function __construct(string $value)
    {
        parent::__construct(sprintf('Invalid Content <%s>', $value));
    }
}
