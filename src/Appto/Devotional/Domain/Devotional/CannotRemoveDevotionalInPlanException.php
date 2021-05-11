<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

class CannotRemoveDevotionalInPlanException extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Can not remove devotional <%s> that is linked by plans', $id));
    }
}
