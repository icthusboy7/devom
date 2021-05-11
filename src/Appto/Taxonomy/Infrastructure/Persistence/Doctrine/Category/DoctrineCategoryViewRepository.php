<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category;

use Appto\Taxonomy\Domain\Category\Category;
use Appto\Taxonomy\Domain\Category\CategoryNotFoundException;
use Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category\Entity\CategoryEntityRepository;
use Appto\Taxonomy\View\Category\CategoryView;
use Appto\Taxonomy\View\Category\CategoryViewAssembler;
use Appto\Taxonomy\View\Category\CategoryViewRepository;

class DoctrineCategoryViewRepository implements CategoryViewRepository
{
    private $repository;
    private $categoryViewAssembler;

    public function __construct(
        CategoryEntityRepository $doctrineRepository,
        CategoryViewAssembler $categoryViewAssembler
    ) {
        $this->repository = $doctrineRepository;
        $this->categoryViewAssembler = $categoryViewAssembler;
    }

    public function get(string $id): CategoryView
    {
        $category = $this->repository->find($id);
        if (!$category) {
            throw new CategoryNotFoundException($id);
        }

        return $this->categoryViewAssembler->assemble($category);
    }

    /**
     * @return CategoryView[]
     */
    public function all(): array
    {
        //WIP custom query with all required view fields
        $categories = $this->repository->findAll();

        return array_map(
            fn(Category $category) => $this->categoryViewAssembler->assemble($category),
            $categories
        );
    }
}
