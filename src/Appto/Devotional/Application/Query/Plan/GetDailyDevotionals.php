<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\QueryHandler;
use Appto\Devotional\View\Plan\DailyDevotionalView;
use Appto\Devotional\View\Plan\YearlyPlanViewRepository;

class GetDailyDevotionals implements QueryHandler
{
    private $repository;

    public function __construct(YearlyPlanViewRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return DailyDevotionalView[]
     */
    public function __invoke(GetDailyDevotionalsRequest $query): array
    {
        $yearlyPlan = $this->repository->get($query->planId());

        return $this->repository->dailyDevotionals($yearlyPlan->id());
    }
}
