<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\QueryHandler;
use Appto\Devotional\Domain\Plan\DailyDevotionalNotFoundException;
use Appto\Devotional\View\Plan\DailyDevotionalView;
use Appto\Devotional\View\Plan\YearlyPlanViewRepository;

class GetDailyDevotional implements QueryHandler
{
    private $repository;

    public function __construct(YearlyPlanViewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetDailyDevotionalRequest $query): DailyDevotionalView
    {
        $yearlyPlan = $this->repository->get($query->planId());

        $dailyDevotional = $this->repository->dailyDevotional($yearlyPlan->id(), $query->devotionalId());

        if (!$dailyDevotional) {
            throw new DailyDevotionalNotFoundException($query->devotionalId());
        }

        return $dailyDevotional;
    }
}
