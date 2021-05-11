<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Plan;

use Appto\Devotional\View\Plan\YearlyPlanView;
use Appto\Devotional\View\Plan\YearlyPlanViewAssembler;

class DoctrineYearlyPlanViewAssembler implements YearlyPlanViewAssembler
{
    public function assemble(\stdClass $yearlyPlan): YearlyPlanView
    {
        $view = new YearlyPlanView(
            $yearlyPlan->id,
            (int)$yearlyPlan->year,
            $yearlyPlan->title,
            $yearlyPlan->coverPhotoUrl ? $yearlyPlan->coverPhotoUrl : null
        );

        return $view;
    }
}
