<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Devotional;

use Appto\Common\Domain\EventHandling\EventBus;
use Appto\Common\Domain\EventSource\AggregateFactory\AggregateFactory;
use Appto\Common\Domain\EventSource\EventSourcingRepository;
use Appto\Common\Domain\EventStore\EventStore;
use Appto\Devotional\Domain\Devotional\Devotional;
use Appto\Devotional\Domain\Devotional\DevotionalNotFoundException;
use Appto\Devotional\Domain\Devotional\DevotionalRepository;
use Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Devotional\Entity\DevotionalEntityRepository;

class DoctrineDevotionalRepository extends EventSourcingRepository implements DevotionalRepository
{
    private $repository;

    public function __construct(
        DevotionalEntityRepository $doctrineRepository,
        EventStore $eventStore,
        EventBus $eventBus,
        AggregateFactory $aggregateFactory,
        array $eventStreamDecorators = []
    ) {
        $this->repository = $doctrineRepository;
        parent::__construct(
            $eventStore,
            $eventBus,
            Devotional::class,
            $aggregateFactory,
            $eventStreamDecorators
        );
    }

    public function find(string $id): ?Devotional
    {
        /** @var null|Devotional $devotional */
        $devotional = $this->repository->find($id);
        return $devotional;
    }

    public function get(string $id): Devotional
    {
        /** @var null|Devotional $devotional */
        $devotional = $this->repository->find($id);
        if (!$devotional) {
            throw new DevotionalNotFoundException($id);
        }

        return $devotional;
    }

    public function save(Devotional $devotional): void
    {
        $this->store($devotional);
        $this->repository->save($devotional);
    }

    public function remove(Devotional $devotional): void
    {
        $this->repository->remove($devotional);
    }
}
