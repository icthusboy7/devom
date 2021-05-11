<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Devotional;

use Appto\Common\Application\Query\Query;

class GetDevotionalRequest implements Query
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
