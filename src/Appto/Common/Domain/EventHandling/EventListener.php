<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventHandling;

use Appto\Common\Domain\DomainMessage;

interface EventListener
{
    public function handle(DomainMessage $domainMessage): void;
}
