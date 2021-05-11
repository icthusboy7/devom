<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Query\Devotional;

use Appto\Common\Application\Query\QueryHandler;
use Appto\Devotional\View\Devotional\DevotionalView;
use Appto\Devotional\View\Devotional\DevotionalViewRepository;

class GetDevotional implements QueryHandler
{
    private DevotionalViewRepository $repository;

    public function __construct(DevotionalViewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetDevotionalRequest $query): DevotionalView
    {
        return $this->repository->get($query->devotionalId());
    }
}
