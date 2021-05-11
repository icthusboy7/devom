<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan\Exception;

use Appto\Common\Domain\Identity\Uuid;

class CannotRemoveDevotionalDoesNotTheLastException extends \DomainException
{
    public function __construct(Uuid $devotionalId)
    {
        parent::__construct(sprintf('Cannot remove devotional <%s> from the plan. Does not the last.', $devotionalId));
    }
}
