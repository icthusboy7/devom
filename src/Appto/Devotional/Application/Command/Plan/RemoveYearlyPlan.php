<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Common\Application\Command\CommandHandler;
use Appto\Devotional\Domain\Plan\YearlyPlanRepository;

class RemoveYearlyPlan implements CommandHandler
{
    private $yearlyPlanRepository;

    public function __construct(YearlyPlanRepository $yearlyPlanRepository)
    {
        $this->yearlyPlanRepository = $yearlyPlanRepository;
    }

    public function __invoke(RemoveYearlyPlanRequest $command): void
    {
        $yearlyPlan = $this->yearlyPlanRepository->get($command->planId());

        $this->yearlyPlanRepository->remove($yearlyPlan);
    }
}
