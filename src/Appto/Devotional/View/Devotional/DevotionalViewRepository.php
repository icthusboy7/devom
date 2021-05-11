<?php

namespace Appto\Devotional\View\Devotional;

interface DevotionalViewRepository
{
    public function find(string $id): ?DevotionalView;
    public function get(string $id): DevotionalView;
    /**
     * @return DevotionalView[]
     */
    public function all(): array;
}
