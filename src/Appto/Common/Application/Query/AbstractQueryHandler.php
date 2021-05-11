<?php

namespace Appto\Common\Application\Query;

abstract class AbstractQueryHandler implements QueryHandler
{
    public function __invoke(Query $query): void
    {
        $this->handle($query);
    }

    abstract public function handle(Query $query): QueryView;
}
