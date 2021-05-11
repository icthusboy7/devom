<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Plan;

use Appto\Devotional\Domain\Plan\PlanNotFoundException;
use Appto\Devotional\Domain\Plan\YearlyPlan;
use Appto\Devotional\Domain\Plan\YearlyPlanRepository;
use Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Plan\Entity\YearlyPlanEntityRepository;

class DoctrineYearlyPlanRepository implements YearlyPlanRepository
{
    private $repository;

    public function __construct(YearlyPlanEntityRepository $doctrineRepository)
    {
        $this->repository = $doctrineRepository;
    }

    public function find(string $planId): ?YearlyPlan
    {
        /** @var null|YearlyPlan $yearlyPlan */
        $yearlyPlan = $this->repository->find($planId);
        return $yearlyPlan;
    }

    public function get(string $planId): YearlyPlan
    {
        /** @var null|YearlyPlan $yearlyPlan */
        $yearlyPlan = $this->repository->find($planId);
        if (!$yearlyPlan) {
            throw new PlanNotFoundException($planId);
        }
        return $yearlyPlan;
    }

    public function save(YearlyPlan $yearlyPlan): void
    {
        $this->repository->save($yearlyPlan);
    }

    public function remove(YearlyPlan $yearlyPlan): void
    {
        $this->repository->remove($yearlyPlan);
    }
}
