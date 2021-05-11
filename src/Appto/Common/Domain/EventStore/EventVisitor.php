<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore;

use Appto\Common\Domain\DomainMessage;

interface EventVisitor
{
    public function doWithEvent(DomainMessage $domainMessage): void;
}
