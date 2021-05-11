<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

class DevotionalAlreadyExistsException extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Devotional <%s> already exists', $id));
    }
}
