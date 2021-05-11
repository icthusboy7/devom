<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category\Entity;

use Appto\Taxonomy\Domain\Category\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CategoryEntityRepository extends ServiceEntityRepository
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        parent::__construct($registry, Category::class);
    }

    public function save(Category $category): void
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush($category);
    }
}
