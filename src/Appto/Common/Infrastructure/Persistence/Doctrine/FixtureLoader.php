<?php

namespace Appto\Common\Infrastructure\Persistence\Doctrine;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;

abstract class FixtureLoader extends AbstractFixture implements FixtureInterface
{
    protected const FIXTURE_EXT = '.{yaml,yml}';

    public function fixtureDir(): string
    {
        return \dirname(__DIR__);
    }
}
