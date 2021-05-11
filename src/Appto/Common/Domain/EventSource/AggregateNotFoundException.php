<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use Exception;
use RuntimeException;

final class AggregateNotFoundException extends RuntimeException
{
    public function __construct(string $id, Exception $previous = null)
    {
        parent::__construct(sprintf("Aggregate with id '%s' not found", $id), 0, $previous);
    }
}
