<?php

namespace Appto\Devotional\Domain\Devotional;

class DevotionalPublished extends DevotionalEvent
{
    private const EVENT_NAME = 'appto.devom.1.event.devotional.published';

    public function eventName(): string
    {
        return self::EVENT_NAME;
    }
}
