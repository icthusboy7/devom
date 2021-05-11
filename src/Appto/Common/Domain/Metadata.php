<?php

declare(strict_types=1);

namespace Appto\Common\Domain;

final class Metadata implements Serializable
{
    private $values = [];

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    public static function kv($key, $value): self
    {
        return new self([$key => $value]);
    }

    public function merge(self $otherMetadata): self
    {
        return new self(array_merge($this->values, $otherMetadata->values));
    }

    public function all(): array
    {
        return $this->values;
    }

    public function get(string $key)
    {
        return $this->values[$key] ?? null;
    }

    public function serialize(): array
    {
        return $this->values;
    }

    public static function deserialize(array $data): self
    {
        return new self($data);
    }
}
