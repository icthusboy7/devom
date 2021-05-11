<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan\Exception;

use Appto\Common\Domain\Identity\Uuid;

class DevotionalIdAlreadyExistsException extends \DomainException
{
    public function __construct(Uuid $id)
    {
        parent::__construct(sprintf('DevotionalId <%s> already exists ', $id));
    }
}
