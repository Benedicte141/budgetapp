<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327173251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank_api CHANGE name name VARCHAR(50) NOT NULL, CHANGE version version VARCHAR(15) NOT NULL, CHANGE field_mapping field_mapping JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE banque DROP FOREIGN KEY FK_B1F6CB3C74F31645');
        $this->addSql('ALTER TABLE banque ADD CONSTRAINT FK_B1F6CB3C74F31645 FOREIGN KEY (bank_api_id) REFERENCES bank_api (id)');
        $this->addSql('ALTER TABLE operation ADD date DATE NOT NULL, CHANGE external_id external_id VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank_api CHANGE name name VARCHAR(255) NOT NULL, CHANGE version version VARCHAR(255) NOT NULL, CHANGE field_mapping field_mapping VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE banque DROP FOREIGN KEY FK_B1F6CB3C74F31645');
        $this->addSql('ALTER TABLE banque ADD CONSTRAINT FK_B1F6CB3C74F31645 FOREIGN KEY (bank_api_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE operation DROP date, CHANGE external_id external_id VARCHAR(255) NOT NULL');
    }
}
