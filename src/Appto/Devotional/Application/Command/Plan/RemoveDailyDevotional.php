<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Devotional\Domain\Plan\DevotionalId;
use Appto\Common\Application\Command\CommandHandler;
use Appto\Devotional\Domain\Plan\YearlyPlanRepository;

class RemoveDailyDevotional implements CommandHandler
{
    private $yearlyPlanRepository;

    public function __construct(YearlyPlanRepository $yearlyPlanRepository)
    {
        $this->yearlyPlanRepository = $yearlyPlanRepository;
    }

    public function __invoke(RemoveDailyDevotionalRequest $command): void
    {
        $yearlyPlan = $this->yearlyPlanRepository->get($command->planId());

        $yearlyPlan->removeDailyDevotional(new DevotionalId($command->devotionalId()));

        $this->yearlyPlanRepository->save($yearlyPlan);
    }
}
