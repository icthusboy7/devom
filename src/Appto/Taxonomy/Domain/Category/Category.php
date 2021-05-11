<?php

namespace Appto\Taxonomy\Domain\Category;

use Appto\Common\Domain\Number\NaturalNumber;
use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    private $id;
    private $title;
    private $description;
    private $position;
    private $parent;
    private $subCategories;

    public function __construct(CategoryId $id, Title $title, ?string $description, ?NaturalNumber $position)
    {
        $this->id            = $id;
        $this->title         = $title;
        $this->description   = $description;
        $this->position      = $position ?? new NaturalNumber(0);
        $this->subCategories = new ArrayCollection();
    }

    public function addSubCategory(CategoryId $id, Title $title, ?string $description): void
    {
        //WIP: validate if not exists

        $subcategory         = new Category(
            $id,
            $title,
            $description,
            new NaturalNumber($this->subCategories->count())
        );
        $subcategory->parent = $this;
        $this->subCategories->set($id, $subcategory);
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function position(): NaturalNumber
    {
        return $this->position;
    }
}
