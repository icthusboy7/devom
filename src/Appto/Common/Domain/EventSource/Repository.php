<?php

declare(strict_types=1);

namespace Appto\Common\Domain\EventSource;

interface Repository
{
    public function store(AggregateRoot $aggregate): void;

    public function load($id): AggregateRoot;
}
