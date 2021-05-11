<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

class PlanAlreadyExistsException extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Plan <%s> already exists', $id));
    }
}
