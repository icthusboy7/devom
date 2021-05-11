<?php

namespace Test\Unit\Appto\Taxonomy\Domain\Category;

use Appto\Common\Domain\Number\NaturalNumber;
use Appto\Common\Infrastructure\PHPUnit\Mother;
use Appto\Taxonomy\Domain\Category\Category;
use Appto\Taxonomy\Domain\Category\CategoryId;
use Appto\Taxonomy\Domain\Category\Title;

class CategoryMother extends Mother
{
    public static function create(
        string $id,
        string $title,
        ?string $description = null,
        ?int $position = null
    ): Category {
        return new Category(
            new CategoryId($id),
            new Title($title),
            $description,
            new NaturalNumber((int)$position)
        );
    }

    public static function random(): Category
    {
        return self::create(
            self::faker()->uuid,
            self::faker()->title,
            self::faker()->paragraph,
            self::faker()->unique()->randomNumber()
        );
    }
}
