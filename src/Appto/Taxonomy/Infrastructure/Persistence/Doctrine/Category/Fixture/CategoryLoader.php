<?php

namespace Appto\Taxonomy\Infrastructure\Persistence\Doctrine\Category\Fixture;

use Appto\Common\Domain\Number\NaturalNumber;
use Appto\Taxonomy\Domain\Category\Category;
use Appto\Taxonomy\Domain\Category\CategoryId;
use Appto\Taxonomy\Domain\Category\Title;
use Appto\Common\Infrastructure\Persistence\Doctrine\FixtureLoader;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class CategoryLoader extends FixtureLoader
{
    public const REFERENCE = 'category';

    public function load(ObjectManager $manager)
    {
        $content = Yaml::parseFile(\dirname(__DIR__) . '/Fixture/dev.yml');

        foreach ($content['category'] as $id => $data) {
            $category = new Category(
                new CategoryId($id),
                new Title($data['title']),
                $data['description'],
                new NaturalNumber($data['position'])
            );
            $manager->persist($category);
            $this->addReference(self::REFERENCE . '_' . $id, $category);
        }

        $manager->flush();
    }
}
