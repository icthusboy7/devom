<?php

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Devotional;

use Appto\Devotional\View\Devotional\TopicView;
use Appto\Devotional\View\Devotional\TopicViewAssembler;

class DoctrineTopicViewAssembler implements TopicViewAssembler
{

    public function assemble($topic): TopicView
    {
        //return new TopicView($topic->id(), $topic->title());
        return new TopicView($topic, 'wip: return a topic object');
    }
}
