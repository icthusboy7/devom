<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use RuntimeException;

final class AggregateRootAlreadyRegisteredException extends RuntimeException
{
}
