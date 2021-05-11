<?php

namespace Appto\Taxonomy\Domain\Category;

use Appto\Common\Domain\StringValueObject;
use Appto\Taxonomy\Domain\Category\Exception\InvalidTitleException;

class Title extends StringValueObject
{
    protected function guard(string $value): void
    {
        if (empty($value)) {
            throw new InvalidTitleException($value);
        }
    }
}
