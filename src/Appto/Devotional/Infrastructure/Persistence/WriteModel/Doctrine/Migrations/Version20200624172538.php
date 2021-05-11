<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624172538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create devotional and plan';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE dev_devotional (
            id UUID NOT NULL, 
            bible_reading VARCHAR(255) DEFAULT NULL, 
            topics JSON DEFAULT NULL, 
            title VARCHAR(255) NOT NULL, 
            content TEXT NOT NULL, 
            audio_url_value VARCHAR(255) DEFAULT NULL, 
            author_id UUID NOT NULL, 
            publisher_id UUID NOT NULL, 
            passage_text VARCHAR(255) NOT NULL, 
            passage_reference VARCHAR(255) NOT NULL, 
            status INT NOT NULL, PRIMARY KEY(id)
        )');

        $this->addSql('CREATE TABLE dev_yearly_plan (
            id UUID NOT NULL, 
            year_value INT NOT NULL, 
            status INT NOT NULL, PRIMARY KEY(id)
        )');

        $this->addSql('CREATE SEQUENCE dev_daily_devotional_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dev_daily_devotional (
            entity_id INT NOT NULL, 
            devotional_id UUID NOT NULL, 
            day INT NOT NULL, 
            year_value INT NOT NULL, 
            PRIMARY KEY(entity_id)
        )');

        $this->addSql('CREATE TABLE dev_yearly_plan_daily_devotionals (
            plan_id UUID NOT NULL, 
            daily_devotional_id INT NOT NULL, 
            PRIMARY KEY(plan_id, daily_devotional_id)
        )');

        $this->addSql('CREATE INDEX IDX_66E03F10E899029B ON dev_yearly_plan_daily_devotionals (plan_id)');
        $this->addSql('CREATE INDEX IDX_66E03F10F47D02A2 ON dev_yearly_plan_daily_devotionals (daily_devotional_id)');

        $this->addSql('ALTER TABLE dev_yearly_plan_daily_devotionals 
            ADD CONSTRAINT FK_66E03F10E899029B FOREIGN KEY (plan_id) REFERENCES dev_yearly_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dev_yearly_plan_daily_devotionals 
            ADD CONSTRAINT FK_66E03F10F47D02A2 FOREIGN KEY (daily_devotional_id) REFERENCES dev_daily_devotional (entity_id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE dev_yearly_plan_daily_devotionals DROP CONSTRAINT FK_66E03F10F47D02A2');
        $this->addSql('ALTER TABLE dev_yearly_plan_daily_devotionals DROP CONSTRAINT FK_66E03F10E899029B');
        $this->addSql('DROP SEQUENCE dev_daily_devotional_entity_id_seq CASCADE');
        $this->addSql('DROP TABLE dev_daily_devotional');
        $this->addSql('DROP TABLE dev_devotional');
        $this->addSql('DROP TABLE dev_yearly_plan');
        $this->addSql('DROP TABLE dev_yearly_plan_daily_devotionals');
    }
}
