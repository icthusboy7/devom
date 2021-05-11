<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

use Appto\Common\Domain\Exception\NotFoundException;

class DevotionalNotFoundException extends \DomainException implements NotFoundException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Devotional <%s> not found', $id));
    }
}
