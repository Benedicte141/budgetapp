<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424121817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, type_abonnement_id INT DEFAULT NULL, periodicite_id INT DEFAULT NULL, organisme_id INT DEFAULT NULL, numero_client VARCHAR(255) NOT NULL, date_souscription DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, objet VARCHAR(255) DEFAULT NULL, INDEX IDX_351268BB813AF326 (type_abonnement_id), INDEX IDX_351268BB2928752A (periodicite_id), INDEX IDX_351268BB5DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_abonnement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB813AF326 FOREIGN KEY (type_abonnement_id) REFERENCES type_abonnement (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB2928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE banque ADD adresse VARCHAR(255) DEFAULT NULL, ADD cp VARCHAR(5) DEFAULT NULL, ADD ville VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE emprunt CHANGE date_deb date_deb DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB813AF326');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB2928752A');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB5DDD38F5');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE type_abonnement');
        $this->addSql('ALTER TABLE banque DROP adresse, DROP cp, DROP ville');
        $this->addSql('ALTER TABLE emprunt CHANGE date_deb date_deb DATE NOT NULL');
    }
}
