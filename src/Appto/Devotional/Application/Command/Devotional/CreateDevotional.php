<?php

declare(strict_types=1);

namespace Appto\Devotional\Application\Command\Devotional;

use Appto\Common\Application\Command\CommandHandler;
use Appto\Devotional\Domain\Devotional\Content;
use Appto\Devotional\Domain\Devotional\Devotional;
use Appto\Devotional\Domain\Devotional\DevotionalAlreadyExistsException;
use Appto\Devotional\Domain\Devotional\DevotionalId;
use Appto\Devotional\Domain\Devotional\DevotionalRepository;
use Appto\Devotional\Domain\Devotional\Passage;
use Appto\Devotional\Domain\Devotional\Title;
use Appto\Common\Domain\Url\Url;
use Appto\Devotional\Domain\Devotional\AuthorId;
use Appto\Devotional\Domain\Devotional\PublisherId;
use Appto\Devotional\Domain\Devotional\TopicId;

class CreateDevotional implements CommandHandler
{
    private $devotionalRepository;

    public function __construct(DevotionalRepository $devotionalRepository)
    {
        $this->devotionalRepository = $devotionalRepository;
    }

    public function __invoke(CreateDevotionalRequest $command): void
    {
        if ($this->devotionalRepository->find($command->devotionalId())) {
            throw new DevotionalAlreadyExistsException($command->devotionalId());
        }

        $devotional = new Devotional(
            new DevotionalId($command->devotionalId()),
            new Title($command->title()),
            new Content($command->content()),
            $command->bibleReading(),
            $command->audioUrl() ? new Url($command->audioUrl()) : null,
            new AuthorId($command->authorId()),
            new PublisherId($command->publisherId()),
            !empty($command->passage())
                ? new Passage($command->passage()->text, $command->passage()->reference)
                : null,
            $command->topics()
                ? array_map(function (string $topicId) {
                    return new TopicId($topicId);
                }, $command->topics())
                : []
        );

        $this->devotionalRepository->save($devotional);
    }
}
