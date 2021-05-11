<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\QueryHandler;
use Appto\Devotional\View\Plan\PlanIdFilter;
use Appto\Devotional\View\Plan\YearlyPlanView;
use Appto\Devotional\View\Plan\YearlyPlanViewRepository;

class GetYearlyPlan implements QueryHandler
{
    private $repository;

    public function __construct(YearlyPlanViewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetYearlyPlanRequest $query): YearlyPlanView
    {
        return $this->repository->get($query->planId());
    }
}
