<?php

declare(strict_types=1);

namespace Appto\Taxonomy\View\Category;

interface CategoryViewRepository
{
    public function get(string $categoryId): CategoryView;

    /**
     * @return CategoryView[]
     */
    public function all(): array;
}
