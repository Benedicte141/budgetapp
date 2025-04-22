<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422072419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque ADD adresse VARCHAR(255) DEFAULT NULL, ADD cp VARCHAR(5) DEFAULT NULL, ADD ville VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE emprunt CHANGE date_deb date_deb DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque DROP adresse, DROP cp, DROP ville');
        $this->addSql('ALTER TABLE emprunt CHANGE date_deb date_deb DATE NOT NULL');
    }
}
