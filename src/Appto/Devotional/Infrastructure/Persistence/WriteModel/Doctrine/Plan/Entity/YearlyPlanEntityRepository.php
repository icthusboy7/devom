<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Plan\Entity;

use Appto\Devotional\Domain\Plan\YearlyPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class YearlyPlanEntityRepository extends ServiceEntityRepository
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        parent::__construct($registry, YearlyPlan::class);
    }

    public function save(YearlyPlan $yearlyPlan): void
    {
        $this->getEntityManager()->persist($yearlyPlan);
        $this->getEntityManager()->flush($yearlyPlan);
    }

    public function remove(YearlyPlan $yearlyPlan): void
    {
        $this->getEntityManager()->remove($yearlyPlan);
        $this->getEntityManager()->flush($yearlyPlan);
    }
}
