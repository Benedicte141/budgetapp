<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116074939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque ADD bank_api_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE banque ADD CONSTRAINT FK_B1F6CB3C74F31645 FOREIGN KEY (bank_api_id) REFERENCES bank_api (id)');
        $this->addSql('CREATE INDEX IDX_B1F6CB3C74F31645 ON banque (bank_api_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque DROP FOREIGN KEY FK_B1F6CB3C74F31645');
        $this->addSql('DROP INDEX IDX_B1F6CB3C74F31645 ON banque');
        $this->addSql('ALTER TABLE banque DROP bank_api_id');
    }
}
