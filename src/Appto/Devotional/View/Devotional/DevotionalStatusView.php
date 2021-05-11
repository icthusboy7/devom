<?php

namespace Appto\Devotional\View\Devotional;

class DevotionalStatusView
{
    public $statusCode;
    public $statusName;
    public $statusDescription;

    public function __construct(string $statusCode, string $statusName, string $statusDescription)
    {
        $this->statusCode = $statusCode;
        $this->statusName = $statusName;
        $this->statusDescription = $statusDescription;
    }
}
