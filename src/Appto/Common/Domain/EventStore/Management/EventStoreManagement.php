<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventStore\Management;

use Appto\Common\Domain\EventStore\EventVisitor;

interface EventStoreManagement
{
    public function visitEvents(Criteria $criteria, EventVisitor $eventVisitor): void;
}
