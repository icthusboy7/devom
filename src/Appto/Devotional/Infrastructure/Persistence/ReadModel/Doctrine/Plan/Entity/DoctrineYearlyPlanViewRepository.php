<?php

declare(strict_types=1);

namespace Appto\Devotional\Infrastructure\Persistence\ReadModel\Doctrine\Plan\Entity;

use Appto\Devotional\Domain\Plan\YearlyPlan;
use Appto\Devotional\View\Plan\Filter;
use Appto\Devotional\View\Plan\SearchCriteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\FetchMode;

class DoctrineYearlyPlanViewRepository extends ServiceEntityRepository
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        parent::__construct($registry, YearlyPlan::class);
    }

    /**
     * @return \stdClass[]
     */
    public function getDailyDevotionals(string $planId): array
    {
        $conn = $this->registry->getConnection();

        $sql = "SELECT d.id, d.title, d.passage_text as \"passageText\", 
                d.passage_reference as \"passageReference\", d.content, d.bible_reading as \"bibleReading\", 
                d.audio_url_value as \"audioUrl\", d.author_id as \"authorId\", d.publisher_id as \"publisherId\", 
                d.topics, d.status, dd.day 
                FROM dev_yearly_plan y
                JOIN dev_yearly_plan_daily_devotionals yd ON y.id = yd.plan_id
                JOIN dev_daily_devotional dd ON dd.entity_id = yd.daily_devotional_id
                LEFT JOIN dev_devotional d ON d.id = dd.devotional_id
                WHERE y.id = ?
                ORDER BY dd.day desc";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $planId);
        $stmt->execute();

        return $stmt->fetchAll(FetchMode::STANDARD_OBJECT);
    }

    public function findDailyDevotional(string $planId, string $devotionalId): ?\stdClass
    {
        $conn = $this->registry->getConnection();

        $sql = "SELECT d.id, d.title, d.passage_text as \"passageText\", 
                d.passage_reference as \"passageReference\", d.content, d.bible_reading as \"bibleReading\", 
                d.audio_url_value as \"audioUrl\", d.author_id as \"authorId\", d.publisher_id as \"publisherId\", 
                d.topics, d.status, dd.day 
                FROM dev_yearly_plan y
                JOIN dev_yearly_plan_daily_devotionals yd
                ON y.id = yd.plan_id
                JOIN dev_daily_devotional dd
                ON dd.entity_id = yd.daily_devotional_id
                LEFT JOIN dev_devotional d
                ON d.id = dd.devotional_id
                WHERE y.id = ? AND dd.devotional_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $planId);
        $stmt->bindValue(2, $devotionalId);
        $stmt->execute();

        $result = $stmt->fetch(FetchMode::STANDARD_OBJECT);

        return $result ? $result : null;
    }

    public function findById(string $planId): ?\stdClass
    {
        $conn = $this->registry->getConnection();

        $sql = "SELECT y.id, y.year_value as year, y.title as title, y.cover_photo_url_value as \"coverPhotoUrl\"
                FROM dev_yearly_plan y
                WHERE y.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $planId);
        $stmt->execute();

        $yearlyPlan =  $stmt->fetch(FetchMode::STANDARD_OBJECT);
        return $yearlyPlan ? $yearlyPlan : null;
    }

    public function findAllByCriteria(SearchCriteria $criteria): array
    {
        $conn = $this->registry->getConnection();

        $sql = $this->selectAllSQL();
        /** @var Filter $filter */
        foreach ($criteria->filters() as $filter) {
            if ('devotionalId' === $filter->name()) {
                $sql = $this->filterByDevotionalIdSQL($filter->value(), $sql);
            }
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(FetchMode::STANDARD_OBJECT);
    }


    private function selectAllSQL(): string
    {
        $sql = "SELECT y.id, y.year_value as year, y.title as title, y.cover_photo_url_value as \"coverPhotoUrl\"
                FROM dev_yearly_plan y";
        return $sql;
    }

    private function filterByDevotionalIdSQL(string $devotionalId, string $sql = ''): string
    {
        $sql = "$sql 
                LEFT JOIN dev_yearly_plan_daily_devotionals yd
                ON y.id = yd.plan_id
                LEFT JOIN dev_daily_devotional dd
                ON dd.entity_id = yd.daily_devotional_id
                WHERE dd.devotional_id = '$devotionalId'";
        return $sql;
    }
}
