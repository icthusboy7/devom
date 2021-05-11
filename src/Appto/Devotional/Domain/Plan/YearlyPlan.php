<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\DateTime\Year;
use Appto\Common\Domain\DateTime\YearlyDay;
use Appto\Devotional\Domain\Plan\Exception\DevotionalIdAlreadyExistsException;
use Appto\Devotional\Domain\Plan\Exception\CannotRemoveDevotionalDoesNotTheLastException;
use Appto\Devotional\Domain\Plan\Exception\InvalidDevotionalDayException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Appto\Common\Domain\Nullable;
use Appto\Common\Domain\Url\Url;

class YearlyPlan
{
    private $id;
    private $year;
    private $dailyDevotionals;
    private $status;
    private $title;
    private $coverPhotoUrl;

    public function __construct(
        PlanId $id,
        Year $year,
        Title $title,
        ?Url $coverPhotoUrl
    ) {
        $this->id = $id;
        $this->year = $year;
        $this->title = $title;
        $this->coverPhotoUrl = $coverPhotoUrl;
        $this->status = PlanStatus::created();
        $this->dailyDevotionals = new ArrayCollection();
    }

    public function addDailyDevotional(DevotionalId $devotionalId, int $day): void
    {
        $dailyDevotional = new DailyDevotional($devotionalId, new YearlyDay($this->year, $day));
        $this->assertDailyDevotional($dailyDevotional);
        $this->dailyDevotionals->add($dailyDevotional);
    }

    private function assertDailyDevotional(DailyDevotional $dailyDevotional): void
    {
        $this->assertDay($dailyDevotional);

        /** @var DailyDevotional $devotional */
        foreach ($this->dailyDevotionals as $devotional) {
            if ($devotional->devotionalId()->equals($dailyDevotional->devotionalId())) {
                throw new DevotionalIdAlreadyExistsException($dailyDevotional->devotionalId());
            }
        }
    }

    private function assertDay(DailyDevotional $dailyDevotional): void
    {
        if ($this->dailyDevotionals->isEmpty() && $dailyDevotional->day()->value() != 1) {
            throw new InvalidDevotionalDayException($dailyDevotional->day());
        }
        if (
            $this->dailyDevotionals()->last()
            && $this->dailyDevotionals()->last()->day()->value() != $dailyDevotional->day()->value() - 1
        ) {
            throw new InvalidDevotionalDayException($dailyDevotional->day());
        }
    }

    public function removeDailyDevotional(DevotionalId $devotionalId): void
    {
        /** @var DailyDevotional $dailyDevotional */
        $dailyDevotional = $this->dailyDevotionals()->last();

        if (false === $dailyDevotional) {
            throw new DailyDevotionalNotFoundException((string)$devotionalId);
        }

        if ($dailyDevotional->devotionalId()->equals($devotionalId)) {
            $this->dailyDevotionals()->removeElement($dailyDevotional);
            return;
        }

        $dailyDevotional = $this->dailyDevotional($devotionalId);
        throw new CannotRemoveDevotionalDoesNotTheLastException($dailyDevotional->devotionalId());
    }

    private function dailyDevotional(DevotionalId $devotionalId): DailyDevotional
    {
        foreach ($this->dailyDevotionals as $dailyDevotional) {
            if ($dailyDevotional->devotionalId()->equals($devotionalId)) {
                return $dailyDevotional;
            }
        }

        throw new DailyDevotionalNotFoundException((string)$devotionalId);
    }

    public function doctrinePostLoad(): void
    {
        if ($this->coverPhotoUrl instanceof Nullable && $this->coverPhotoUrl->isNull()) {
            $this->coverPhotoUrl = null;
        }
    }

    public function id(): PlanId
    {
        return $this->id;
    }

    public function year(): Year
    {
        return $this->year;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function coverPhotoUrl(): ?Url
    {
        return $this->coverPhotoUrl;
    }

    /**
     * @return DailyDevotional[]|Collection
     */
    public function dailyDevotionals(): Collection
    {
        return $this->dailyDevotionals;
    }

    public function status(): PlanStatus
    {
        return $this->status;
    }
}
