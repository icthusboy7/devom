<?php

namespace Appto\Common\Domain;

interface Serializable
{
    public static function deserialize(array $data);
    public function serialize(): array;
}
