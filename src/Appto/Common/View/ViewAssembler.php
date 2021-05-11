<?php

namespace Appto\Common\View;

interface ViewAssembler
{
    public function assemble($object): View;
}
