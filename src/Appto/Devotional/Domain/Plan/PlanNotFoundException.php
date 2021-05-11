<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\Exception\NotFoundException;

class PlanNotFoundException extends \DomainException implements NotFoundException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Plan <%s> not found', $id));
    }
}
