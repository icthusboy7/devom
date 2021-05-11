<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Plan;

use Appto\Common\Application\Query\Query;
use Appto\Common\Application\Query\QueryHandler;
use Appto\Devotional\View\Plan\Filter;
use Appto\Devotional\View\Plan\SearchCriteria;
use Appto\Devotional\View\Plan\YearlyPlanView;
use Appto\Devotional\View\Plan\YearlyPlanViewRepository;

class ListYearlyPlan implements QueryHandler
{
    private $repository;

    public function __construct(YearlyPlanViewRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return YearlyPlanView[]
     */
    public function __invoke(ListYearlyPlanRequest $query): array
    {
        return $this->repository->all($this->buildSearchCriteria($query));
    }

    private function buildSearchCriteria(ListYearlyPlanRequest $query): SearchCriteria
    {
        $criteria = new SearchCriteria();
        if ($query->devotionalId()) {
            $criteria->add(new Filter('devotionalId', '=', $query->devotionalId()));
        }
        return $criteria;
    }
}
