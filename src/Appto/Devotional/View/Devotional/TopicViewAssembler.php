<?php

namespace Appto\Devotional\View\Devotional;

interface TopicViewAssembler
{
    public function assemble($topic): TopicView;
}
