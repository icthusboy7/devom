<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Devotional;

use Appto\Common\Application\Command\CommandHandler;
use Appto\Devotional\Application\Query\Plan\ListYearlyPlan;
use Appto\Devotional\Application\Query\Plan\ListYearlyPlanRequest;
use Appto\Devotional\Domain\Devotional\CannotRemoveDevotionalInPlanException;
use Appto\Devotional\Domain\Devotional\DevotionalRepository;
use Appto\Devotional\View\Plan\DevotionalIdFilter;

class RemoveDevotional implements CommandHandler
{
    private $devotionalRepository;
    private $listYearlyPlan;

    public function __construct(
        DevotionalRepository $devotionalRepository,
        ListYearlyPlan $listYearlyPlan
    ) {
        $this->devotionalRepository = $devotionalRepository;
        $this->listYearlyPlan = $listYearlyPlan;
    }

    public function __invoke(RemoveDevotionalRequest $command): void
    {
        $yearlyPlans = ($this->listYearlyPlan)(new ListYearlyPlanRequest($command->devotionalId()));
        if ($yearlyPlans) {
            throw new CannotRemoveDevotionalInPlanException($command->devotionalId());
        }

        $devotional = $this->devotionalRepository->get($command->devotionalId());

        $this->devotionalRepository->remove($devotional);
    }
}
