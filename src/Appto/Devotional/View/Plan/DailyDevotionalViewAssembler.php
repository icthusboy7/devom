<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Plan;

interface DailyDevotionalViewAssembler
{
    public function assemble(\stdClass $dailyDevotional): DailyDevotionalView;
}
