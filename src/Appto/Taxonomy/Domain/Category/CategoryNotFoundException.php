<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Domain\Category;

use Appto\Common\Domain\Exception\NotFoundException;

class CategoryNotFoundException extends \DomainException implements NotFoundException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Category <%s> not found', $id));
    }
}
