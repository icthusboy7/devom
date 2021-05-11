<?php

namespace Appto\Taxonomy\View\Category;

interface CategoryViewAssembler
{
    public function assemble($category): CategoryView;
}
