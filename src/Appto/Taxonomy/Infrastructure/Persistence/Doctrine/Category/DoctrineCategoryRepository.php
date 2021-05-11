<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category;

use Appto\Taxonomy\Domain\Category\Category;
use Appto\Taxonomy\Domain\Category\CategoryNotFoundException;
use Appto\Taxonomy\Domain\Category\CategoryRepository;
use Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category\Entity\CategoryEntityRepository;

class DoctrineCategoryRepository implements CategoryRepository
{
    private $entityRepository;

    public function __construct(CategoryEntityRepository $entityRepository)
    {
        $this->entityRepository  = $entityRepository;
    }

    public function find(string $id): ?Category
    {
        /** @var null|Category $category */
        $category = $this->entityRepository->find($id);
        return $category;
    }

    public function save(Category $category): void
    {
        $this->entityRepository->save($category);
    }

    /**
     * @return Category[] array
     */
    public function all(): array
    {
        $categories = $this->entityRepository->findAll();
        return $categories;
    }

    public function get(string $id): Category
    {
        $category = $this->find($id);
        if (is_null($category)) {
            throw new CategoryNotFoundException($id);
        }

        return $category;
    }
}
