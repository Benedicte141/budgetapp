<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217102601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation ADD contrat_assurance_vie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DC59B5C56 FOREIGN KEY (contrat_assurance_vie_id) REFERENCES contrat_assurance_vie (id)');
        $this->addSql('CREATE INDEX IDX_1981A66DC59B5C56 ON operation (contrat_assurance_vie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66DC59B5C56');
        $this->addSql('DROP INDEX IDX_1981A66DC59B5C56 ON operation');
        $this->addSql('ALTER TABLE operation DROP contrat_assurance_vie_id');
    }
}
