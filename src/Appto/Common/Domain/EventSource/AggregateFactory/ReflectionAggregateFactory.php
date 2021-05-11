<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource\AggregateFactory;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\EventSource\AggregateRoot;
use LogicException;
use ReflectionClass;

/**
 * Creates aggregates with reflection without constructor.
 */
final class ReflectionAggregateFactory implements AggregateFactory
{
    /**
     * {@inheritdoc}
     */
    public function create(string $aggregateClass, DomainEventStream $domainEventStream): AggregateRoot
    {
        $class = new ReflectionClass($aggregateClass);
        $aggregate = $class->newInstanceWithoutConstructor();

        if (!$aggregate instanceof AggregateRoot) {
            throw new LogicException(sprintf('Impossible to initialize "%s"', $aggregateClass));
        }

        $aggregate->initializeState($domainEventStream);

        return $aggregate;
    }
}
