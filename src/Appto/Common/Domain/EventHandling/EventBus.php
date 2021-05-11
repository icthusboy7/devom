<?php

/*
 * This file is part of the broadway/broadway package.
 *
 * (c) 2020 Broadway project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appto\Common\Domain\EventHandling;

use Appto\Common\Domain\DomainEventStream;

interface EventBus
{
    public function subscribe(EventListener $eventListener): void;

    public function publish(DomainEventStream $domainMessages): void;
}
