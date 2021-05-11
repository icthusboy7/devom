<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200524172538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'create category';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE tax_category (
            id UUID NOT NULL, 
            parent_id UUID DEFAULT NULL, 
            description VARCHAR(255) NOT NULL, 
            title VARCHAR(255) NOT NULL, 
            position_value INT NOT NULL, 
            PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D8B87F727ACA70 ON tax_category (parent_id)');
        
        $this->addSql('CREATE TABLE tax_category_subcategories (
            category_id UUID NOT NULL, 
            subcategory_id UUID NOT NULL, 
            PRIMARY KEY(category_id, subcategory_id)
        )');

        $this->addSql('CREATE INDEX IDX_1EE9D7F512469DE2 ON tax_category_subcategories (category_id)');
        $this->addSql('CREATE INDEX IDX_1EE9D7F55DC6FE57 ON tax_category_subcategories (subcategory_id)');

        $this->addSql('ALTER TABLE tax_category ADD CONSTRAINT FK_E6D8B87F727ACA70 FOREIGN KEY (parent_id) REFERENCES tax_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tax_category_subcategories ADD CONSTRAINT FK_1EE9D7F512469DE2 FOREIGN KEY (category_id) REFERENCES tax_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tax_category_subcategories ADD CONSTRAINT FK_1EE9D7F55DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES tax_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tax_category DROP CONSTRAINT FK_E6D8B87F727ACA70');
        $this->addSql('ALTER TABLE tax_category_subcategories DROP CONSTRAINT FK_1EE9D7F512469DE2');
        $this->addSql('ALTER TABLE tax_category_subcategories DROP CONSTRAINT FK_1EE9D7F55DC6FE57');
        $this->addSql('DROP TABLE tax_category');
        $this->addSql('DROP TABLE tax_category_subcategories');
    }
}
