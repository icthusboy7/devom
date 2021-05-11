<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Plan;

interface YearlyPlanViewRepository
{
    /**
     * @return DailyDevotionalView[]
     */
    public function dailyDevotionals(string $planId): array;

    public function dailyDevotional(string $planId, string $devotionalId): ?DailyDevotionalView;

    public function find(string $id): ?YearlyPlanView;
    public function get(string $id): YearlyPlanView;

    /**
     * @return YearlyPlanView[]
     */
    public function all(SearchCriteria $criteria): array;
}
