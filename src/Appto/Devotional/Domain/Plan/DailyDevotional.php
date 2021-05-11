<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Plan;

use Appto\Common\Domain\DateTime\YearlyDay;

class DailyDevotional
{
    private $devotionalId;
    private $day;

    /** @var string $entityId ONLY FOR DOCTRINE MAPPING*/
    private $entityId;

    public function __construct(DevotionalId $devotionalId, YearlyDay $day)
    {
        $this->devotionalId = $devotionalId;
        $this->day = $day;
    }

    public function devotionalId(): DevotionalId
    {
        return $this->devotionalId;
    }

    public function day(): YearlyDay
    {
        return $this->day;
    }
}
