<?php

namespace Appto\Devotional\View\Plan;

interface YearlyPlanViewAssembler
{
    public function assemble(\stdClass $yearlyPlan): YearlyPlanView;
}
