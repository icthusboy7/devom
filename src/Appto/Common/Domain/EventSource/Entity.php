<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

use Appto\Common\Domain\DomainEvent;

abstract class Entity implements EventSourcedEntity
{
    /**
     * @var AggregateRoot|null
     */
    private $aggregateRoot;

    public function handleRecursively(DomainEvent $event): void
    {
        $this->handle($event);

        foreach ($this->childEntities() as $entity) {
            $entity->registerAggregateRoot($this->aggregateRoot);
            $entity->handleRecursively($event);
        }
    }

    public function registerAggregateRoot(AggregateRoot $aggregateRoot): void
    {
        if (null !== $this->aggregateRoot && $this->aggregateRoot !== $aggregateRoot) {
            throw new AggregateRootAlreadyRegisteredException();
        }

        $this->aggregateRoot = $aggregateRoot;
    }

    /**
     * @param mixed $event
     */
    protected function record($event): void
    {
        $this->aggregateRoot->record($event);
    }

    protected function handle(DomainEvent $event): void
    {
        $method = $this->applyMethod($event);

        if (!method_exists($this, $method)) {
            return;
        }

        $this->$method($event);
    }

    /**
     * Returns all child entities.
     *
     * @return EventSourcedEntity[]
     */
    protected function childEntities(): array
    {
        return [];
    }

    private function applyMethod(DomainEvent $event): string
    {
        $classParts = explode('\\', get_class($event));

        return 'apply' . end($classParts);
    }
}
