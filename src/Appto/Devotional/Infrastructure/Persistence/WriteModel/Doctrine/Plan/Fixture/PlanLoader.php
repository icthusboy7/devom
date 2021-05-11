<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\WriteModel\Doctrine\Plan\Fixture;

use Appto\Common\Domain\DateTime\Year;
use Appto\Devotional\Domain\Plan\DevotionalId;
use Appto\Devotional\Domain\Plan\PlanId;
use Appto\Devotional\Domain\Plan\YearlyPlan;
use Appto\Devotional\Domain\Plan\Title;
use Appto\Common\Domain\Url\Url;
use Appto\Common\Infrastructure\Persistence\Doctrine\FixtureLoader;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class PlanLoader extends FixtureLoader implements FixtureGroupInterface
{
    public const REFERENCE = 'yearly_plan';

    public function load(ObjectManager $manager)
    {
        $content = Yaml::parseFile(\dirname(__DIR__) . '/Fixture/dev.yml');

        foreach ($content[self::REFERENCE] as $id => $data) {
            $plan = new YearlyPlan(
                new PlanId($id),
                new Year($data['year']),
                new Title($data['title']),
                $data['coverPhotoUrl'] ? new Url($data['coverPhotoUrl']) : null
            );

            array_map(
                function ($dailyDevotional) use ($plan) {
                    $plan->addDailyDevotional(
                        new DevotionalId($dailyDevotional['devotional_id']),
                        $dailyDevotional['day']
                    );
                },
                $data['devotionals'] ?? []
            );

            $manager->persist($plan);
            $this->addReference(self::REFERENCE . '_' . $id, $plan);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['devotional', 'plan'];
    }
}
