<?php

declare(strict_types=1);

namespace Appto\Devotional\Domain\Devotional;

class Passage
{
    private $text;
    private $reference;

    public function __construct(string $text, string $reference)
    {
        $this->text = $text;
        $this->reference = $reference;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function text(): string
    {
        return $this->text;
    }
}
