<?php

namespace Appto\Taxonomy\Domain\Category\Exception;

use Appto\Common\Domain\Exception\DomainException;

class InvalidTitleException extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct("Invalid Title <$value>");
    }
}
