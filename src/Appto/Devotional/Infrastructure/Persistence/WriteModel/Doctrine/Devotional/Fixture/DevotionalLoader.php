<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Devotional\Fixture;

use Appto\Devotional\Domain\Devotional\Devotional;
use Appto\Devotional\Domain\Devotional\DevotionalId;
use Appto\Devotional\Domain\Devotional\Title;
use Appto\Devotional\Domain\Devotional\Passage;
use Appto\Devotional\Domain\Devotional\Content;
use Appto\Common\Domain\Url\Url;
use Appto\Devotional\Domain\Devotional\AuthorId;
use Appto\Devotional\Domain\Devotional\PublisherId;
use Appto\Devotional\Domain\Devotional\TopicId;
use Appto\Common\Infrastructure\Persistence\Doctrine\FixtureLoader;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class DevotionalLoader extends FixtureLoader
{
    public const REFERENCE = 'devotional';

    public function load(ObjectManager $manager)
    {
        $content = Yaml::parseFile(\dirname(__DIR__) . '/Fixture/dev.yml');

        foreach ($content['devotional'] as $id => $data) {
            $topics = [];
            if (isset($data['topicIds'])) {
                foreach ($data['topicIds'] as $topicId) {
                    $topics[] = new TopicId($topicId);
                }
            }

            $devotional = new Devotional(
                new DevotionalId($id),
                new Title($data['title']),
                new Content($data['content']),
                $data['bibleReading'],
                $data['audioUrl'] ? new Url($data['audioUrl']) : null,
                new AuthorId($data['authorId']),
                new PublisherId($data['publisherId']),
                new Passage($data['text'], $data['reference']),
                $topics
            );
            $manager->persist($devotional);
            $this->addReference(self::REFERENCE . '_' . $id, $devotional);
        }

        $manager->flush();
    }
}
