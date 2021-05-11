<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Application\Query\Category;

use Appto\Common\Application\Query\Query;

class GetCategoryRequest implements Query
{
    private string $categoryId;

    public function __construct(string $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }
}
