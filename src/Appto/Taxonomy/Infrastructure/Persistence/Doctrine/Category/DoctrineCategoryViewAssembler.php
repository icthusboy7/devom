<?php

namespace Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category;

use Appto\Taxonomy\View\Category\CategoryView;
use Appto\Taxonomy\View\Category\CategoryViewAssembler;

class DoctrineCategoryViewAssembler implements CategoryViewAssembler
{

    public function assemble($category): CategoryView
    {
        return new CategoryView(
            $category->id(),
            $category->title(),
            $category->description(),
            $category->position()->value()
        );
    }
}
