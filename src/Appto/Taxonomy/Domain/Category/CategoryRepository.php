<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Domain\Category;

interface CategoryRepository
{
    public function save(Category $category): void;
    public function find(string $id): ?Category;

    /**
     * @return Category[]
     */
    public function all(): array;
    public function get(string $id): Category;
}
