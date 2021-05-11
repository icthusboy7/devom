<?php

declare(strict_types=1);

namespace Appto\Devotional\View\Devotional;

use Appto\Devotional\Domain\Devotional\Devotional;

interface DevotionalViewAssembler
{
    public function assemble(Devotional $devotional): DevotionalView;
}
