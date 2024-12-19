<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217102118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD compagnie_assurance_id INT NOT NULL, ADD mode_gestion_id INT NOT NULL, ADD periodicite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F46849F67FD FOREIGN KEY (compagnie_assurance_id) REFERENCES compagnie_assurance (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F464F001650 FOREIGN KEY (mode_gestion_id) REFERENCES mode_gestion (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F462928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('CREATE INDEX IDX_964C7F46849F67FD ON contrat_assurance_vie (compagnie_assurance_id)');
        $this->addSql('CREATE INDEX IDX_964C7F464F001650 ON contrat_assurance_vie (mode_gestion_id)');
        $this->addSql('CREATE INDEX IDX_964C7F462928752A ON contrat_assurance_vie (periodicite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F46849F67FD');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F464F001650');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F462928752A');
        $this->addSql('DROP INDEX IDX_964C7F46849F67FD ON contrat_assurance_vie');
        $this->addSql('DROP INDEX IDX_964C7F464F001650 ON contrat_assurance_vie');
        $this->addSql('DROP INDEX IDX_964C7F462928752A ON contrat_assurance_vie');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP compagnie_assurance_id, DROP mode_gestion_id, DROP periodicite_id');
    }
}
