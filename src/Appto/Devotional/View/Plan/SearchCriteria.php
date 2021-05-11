<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Plan;

class SearchCriteria
{
    private $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = [];
        array_map(function (Filter $filter) {
            $this->add($filter);
        }, $filters);
    }

    public function add(Filter $filter): void
    {
        $this->filters[$filter->name()] = $filter;
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
