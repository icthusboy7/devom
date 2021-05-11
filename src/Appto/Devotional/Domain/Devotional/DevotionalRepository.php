<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

interface DevotionalRepository
{
    public function find(string $id): ?Devotional;
    public function get(string $id): ?Devotional;
    public function save(Devotional $devotional): void;
    public function remove(Devotional $devotional): void;
}
