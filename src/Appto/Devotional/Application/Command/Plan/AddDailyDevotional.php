<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Devotional\Domain\Plan\DevotionalId;
use Appto\Common\Application\Command\CommandHandler;
use Appto\Devotional\Domain\Plan\YearlyPlanRepository;
use Appto\Devotional\View\Devotional\DevotionalViewRepository;

class AddDailyDevotional implements CommandHandler
{
    private YearlyPlanRepository $yearlyPlanRepository;
    private DevotionalViewRepository $devotionalRepository;

    public function __construct(
        YearlyPlanRepository $yearlyPlanRepository,
        DevotionalViewRepository $devotionalRepository
    ) {
        $this->yearlyPlanRepository = $yearlyPlanRepository;
        $this->devotionalRepository = $devotionalRepository;
    }

    public function __invoke(AddDailyDevotionalRequest $command): void
    {
        $yearlyPlan = $this->yearlyPlanRepository->get($command->planId());

        $devotional = $this->devotionalRepository->get($command->devotionalId());

        $yearlyPlan->addDailyDevotional(new DevotionalId($devotional->id()), $command->day());

        $this->yearlyPlanRepository->save($yearlyPlan);
    }
}
