<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Devotional\Entity;

use Appto\Devotional\Domain\Devotional\Devotional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class DevotionalEntityRepository extends ServiceEntityRepository
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        parent::__construct($registry, Devotional::class);
    }

    public function save(Devotional $devotional): void
    {
        $this->getEntityManager()->persist($devotional);
        $this->getEntityManager()->flush($devotional);
    }

    public function remove(Devotional $devotional): void
    {
        $this->getEntityManager()->remove($devotional);
        $this->getEntityManager()->flush($devotional);
    }
}
