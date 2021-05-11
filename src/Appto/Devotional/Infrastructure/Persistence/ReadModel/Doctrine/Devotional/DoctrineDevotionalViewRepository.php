<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Devotional;

use Appto\Devotional\Domain\Devotional\Devotional;
use Appto\Devotional\Domain\Devotional\DevotionalNotFoundException;
use Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Devotional\Entity\DevotionalEntityRepository;
use Appto\Devotional\View\Devotional\DevotionalView;
use Appto\Devotional\View\Devotional\DevotionalViewAssembler;
use Appto\Devotional\View\Devotional\DevotionalViewRepository;

class DoctrineDevotionalViewRepository implements DevotionalViewRepository
{
    private $repository;
    private $devotionalViewAssembler;


    public function __construct(
        DevotionalEntityRepository $doctrineRepository,
        DevotionalViewAssembler $devotionalViewAssembler
    ) {
        $this->repository = $doctrineRepository;
        $this->devotionalViewAssembler = $devotionalViewAssembler;
    }

    public function find(string $id): ?DevotionalView
    {
        $devotional = $this->repository->find($id);
        return $devotional ? $this->devotionalViewAssembler->assemble($devotional) : $devotional;
    }

    public function get(string $id): DevotionalView
    {
        $devotional = $this->repository->find($id);
        if (!$devotional) {
            throw new DevotionalNotFoundException($id);
        }

        return $this->devotionalViewAssembler->assemble($devotional);
    }

    public function all(): array
    {
        //WIP custom query with all required view fields
        $devotionals = $this->repository->findAll();
        return array_map(
            fn(Devotional $devotional) => $this->devotionalViewAssembler->assemble($devotional),
            $devotionals
        );
    }
}
