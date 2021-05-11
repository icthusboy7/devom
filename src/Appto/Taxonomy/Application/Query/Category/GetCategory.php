<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Application\Query\Category;

use Appto\Common\Application\Query\QueryHandler;
use Appto\Taxonomy\View\Category\CategoryView;
use Appto\Taxonomy\View\Category\CategoryViewRepository;

class GetCategory implements QueryHandler
{
    private CategoryViewRepository $repository;

    public function __construct(CategoryViewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetCategoryRequest $query): CategoryView
    {
        return $this->repository->get($query->categoryId());
    }
}
