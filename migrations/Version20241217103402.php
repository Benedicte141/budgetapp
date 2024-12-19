<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217103402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, periodicite_id INT NOT NULL, type_emprunt_id INT NOT NULL, banque_id INT NOT NULL, montant_initial DOUBLE PRECISION NOT NULL, montant_echeance DOUBLE PRECISION NOT NULL, cout_interet DOUBLE PRECISION NOT NULL, montant_rest_du DOUBLE PRECISION DEFAULT NULL, date_deb DATE NOT NULL, taux DOUBLE PRECISION NOT NULL, objet VARCHAR(255) NOT NULL, duree INT NOT NULL, INDEX IDX_364071D72928752A (periodicite_id), INDEX IDX_364071D7B37C39B1 (type_emprunt_id), INDEX IDX_364071D737E080D9 (banque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periodicite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_emprunt (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D72928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7B37C39B1 FOREIGN KEY (type_emprunt_id) REFERENCES type_emprunt (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D737E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D72928752A');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7B37C39B1');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D737E080D9');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE periodicite');
        $this->addSql('DROP TABLE type_emprunt');
    }
}
