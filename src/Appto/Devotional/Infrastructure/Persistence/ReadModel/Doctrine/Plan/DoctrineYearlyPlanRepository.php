<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Plan;

use Appto\Devotional\Domain\Plan\PlanNotFoundException;
use Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Plan\Entity\DoctrineYearlyPlanViewRepository;
use Appto\Devotional\View\Plan\DailyDevotionalView;
use Appto\Devotional\View\Plan\Filter;
use Appto\Devotional\View\Plan\SearchCriteria;
use Appto\Devotional\View\Plan\YearlyPlanView;
use Appto\Devotional\View\Plan\YearlyPlanViewAssembler;
use Appto\Devotional\View\Plan\DailyDevotionalViewAssembler;
use Appto\Devotional\View\Plan\YearlyPlanViewRepository;

class DoctrineYearlyPlanRepository implements YearlyPlanViewRepository
{
    private $repository;
    private $yearlyPlanViewAssembler;
    private $dailyDevotionalViewAssembler;

    public function __construct(
        DoctrineYearlyPlanViewRepository $doctrineRepository,
        YearlyPlanViewAssembler $yearlyPlanViewAssembler,
        DailyDevotionalViewAssembler $dailyDevotionalViewAssembler
    ) {
        $this->repository = $doctrineRepository;
        $this->yearlyPlanViewAssembler = $yearlyPlanViewAssembler;
        $this->dailyDevotionalViewAssembler = $dailyDevotionalViewAssembler;
    }

    /**
     * @return DailyDevotionalView[]
     */
    public function dailyDevotionals(string $planId): array
    {
        $dailyDevotionals = $this->repository->getDailyDevotionals($planId);

        return array_map(
            fn(\stdClass $dailyDevotional) => $this->dailyDevotionalViewAssembler->assemble($dailyDevotional),
            $dailyDevotionals
        );
    }

    public function dailyDevotional(string $planId, string $devotionalId): ?DailyDevotionalView
    {
        $dailyDevotional = $this->repository->findDailyDevotional($planId, $devotionalId);

        return $dailyDevotional ? $this->dailyDevotionalViewAssembler->assemble($dailyDevotional) : $dailyDevotional;
    }

    public function find(string $id): ?YearlyPlanView
    {
        $yearlyPlan = $this->repository->findById($id);
        return $yearlyPlan ? $this->yearlyPlanViewAssembler->assemble($yearlyPlan) : $yearlyPlan;
    }

    public function get(string $id): YearlyPlanView
    {
        $yearlyPlan = $this->repository->findById($id);
        if (!$yearlyPlan) {
            throw new PlanNotFoundException($id);
        }
        return $this->yearlyPlanViewAssembler->assemble($yearlyPlan);
    }

    /**
     * @return YearlyPlanView[]
     */
    public function all(SearchCriteria $criteria): array
    {
        //WIP criteria to DQL/SQL
        $plans = $this->repository->findAllByCriteria($criteria);

        return array_map(
            fn(\stdClass $yearlyPlan) => $this->yearlyPlanViewAssembler->assemble($yearlyPlan),
            $plans
        );
    }
}
