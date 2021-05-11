<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Domain\Category;

class CategoryAlreadyExistsException extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Category <%s> already exists', $id));
    }
}
