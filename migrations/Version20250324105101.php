<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250324105101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_api (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, version VARCHAR(15) NOT NULL, field_mapping JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE import_error (id INT AUTO_INCREMENT NOT NULL, compte_id INT DEFAULT NULL, error_type VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, raw_data VARCHAR(255) NOT NULL, INDEX IDX_B08813BFF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE import_error ADD CONSTRAINT FK_B08813BFF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE banque ADD bank_api_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE banque ADD CONSTRAINT FK_B1F6CB3C74F31645 FOREIGN KEY (bank_api_id) REFERENCES bank_api (id)');
        $this->addSql('CREATE INDEX IDX_B1F6CB3C74F31645 ON banque (bank_api_id)');
        $this->addSql('ALTER TABLE operation ADD external_id VARCHAR(100) DEFAULT NULL, ADD date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque DROP FOREIGN KEY FK_B1F6CB3C74F31645');
        $this->addSql('ALTER TABLE import_error DROP FOREIGN KEY FK_B08813BFF2C56620');
        $this->addSql('DROP TABLE bank_api');
        $this->addSql('DROP TABLE import_error');
        $this->addSql('DROP INDEX IDX_B1F6CB3C74F31645 ON banque');
        $this->addSql('ALTER TABLE banque DROP bank_api_id');
        $this->addSql('ALTER TABLE operation DROP external_id, DROP date');
    }
}
