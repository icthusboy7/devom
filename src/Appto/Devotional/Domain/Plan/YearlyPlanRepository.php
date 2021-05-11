<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

interface YearlyPlanRepository
{
    public function find(string $planId): ?YearlyPlan;
    public function get(string $planId): YearlyPlan;
    public function save(YearlyPlan $yearlyPlan): void;
    public function remove(YearlyPlan $yearlyPlan): void;
}
