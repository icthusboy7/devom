<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Devotional;

use Appto\Common\Application\Command\Command;

class RemoveDevotionalRequest implements Command
{
    private $devotionalId;

    public function __construct(string $devotionalId)
    {
        $this->devotionalId = $devotionalId;
    }

    public function devotionalId(): string
    {
        return $this->devotionalId;
    }
}
