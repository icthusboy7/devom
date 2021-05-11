<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Plan;

use Appto\Devotional\Domain\Plan\PlanAlreadyExistsException;
use Appto\Devotional\Domain\Plan\YearlyPlan;
use Appto\Devotional\Domain\Plan\YearlyPlanRepository;
use Appto\Devotional\Domain\Plan\PlanId;
use Appto\Common\Domain\DateTime\Year;
use Appto\Devotional\Domain\Plan\Title;
use Appto\Common\Domain\Url\Url;
use Appto\Common\Application\Command\CommandHandler;

class CreateYearlyPlan implements CommandHandler
{
    private $yearlyPlanRepository;

    public function __construct(YearlyPlanRepository $yearlyPlanRepository)
    {
        $this->yearlyPlanRepository = $yearlyPlanRepository;
    }

    public function __invoke(CreateYearlyPlanRequest $command): void
    {
        if ($this->yearlyPlanRepository->find($command->id())) {
            throw new PlanAlreadyExistsException($command->id());
        }

        $yearlyPlan = new YearlyPlan(
            new PlanId($command->id()),
            new Year($command->year()),
            new Title($command->title()),
            $command->coverPhotoUrl() ? new Url($command->coverPhotoUrl()) : null,
        );

        $this->yearlyPlanRepository->save($yearlyPlan);
    }
}
