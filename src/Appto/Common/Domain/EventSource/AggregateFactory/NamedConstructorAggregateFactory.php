<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource\AggregateFactory;

use Appto\Common\Domain\DomainEventStream;
use Appto\Common\Domain\EventSource\AggregateRoot;
use Assert\Assertion as Assert;

/**
 * Creates aggregates by passing a DomainEventStream to the given public static method
 * which is itself responsible for returning an instance of itself.
 * E.g. (\Vendor\AggregateRoot::instantiateForReconstitution())->initializeState($domainEventStream);.
 */
final class NamedConstructorAggregateFactory implements AggregateFactory
{
    /**
     * @var string the name of the method to call on the Aggregate
     */
    private $staticConstructorMethod;

    public function __construct(string $staticConstructorMethod = 'instantiateForReconstitution')
    {
        $this->staticConstructorMethod = $staticConstructorMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $aggregateClass, DomainEventStream $domainEventStream): AggregateRoot
    {
        $methodCall = sprintf('%s::%s', $aggregateClass, $this->staticConstructorMethod);

        Assert::true(
            method_exists($aggregateClass, $this->staticConstructorMethod),
            sprintf('NamedConstructorAggregateFactory expected %s to exist', $methodCall)
        );

        $aggregate = call_user_func($methodCall);

        Assert::isInstanceOf($aggregate, $aggregateClass);

        $aggregate->initializeState($domainEventStream);

        return $aggregate;
    }
}
