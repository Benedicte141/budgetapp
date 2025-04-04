<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241219145949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, type_abonnement_id INT DEFAULT NULL, periodicite_id INT DEFAULT NULL, organisme_id INT DEFAULT NULL, numero_client VARCHAR(255) NOT NULL, date_souscription DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, objet VARCHAR(255) DEFAULT NULL, INDEX IDX_351268BB813AF326 (type_abonnement_id), INDEX IDX_351268BB2928752A (periodicite_id), INDEX IDX_351268BB5DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie_assurance (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, periodicite_id INT DEFAULT NULL, compagnie_id INT DEFAULT NULL, type_contrat_id INT DEFAULT NULL, date_sous DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, libelle_couverture VARCHAR(255) NOT NULL, num_client VARCHAR(255) NOT NULL, INDEX IDX_603499932928752A (periodicite_id), INDEX IDX_6034999352FBE437 (compagnie_id), INDEX IDX_60349993520D03A (type_contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat_assurance_vie (id INT AUTO_INCREMENT NOT NULL, compagnie_assurance_id INT NOT NULL, mode_gestion_id INT NOT NULL, periodicite_id INT DEFAULT NULL, solde NUMERIC(15, 2) NOT NULL, montant_value_latente NUMERIC(15, 2) NOT NULL, total_investit NUMERIC(15, 2) NOT NULL, numero VARCHAR(50) NOT NULL, total_rachete NUMERIC(15, 2) NOT NULL, date_ouverture DATE NOT NULL, montant_versement_libre NUMERIC(15, 2) DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_964C7F46849F67FD (compagnie_assurance_id), INDEX IDX_964C7F464F001650 (mode_gestion_id), INDEX IDX_964C7F462928752A (periodicite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_gestion (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_abonnement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_compte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contrat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB813AF326 FOREIGN KEY (type_abonnement_id) REFERENCES type_abonnement (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB2928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499932928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_6034999352FBE437 FOREIGN KEY (compagnie_id) REFERENCES compagnie (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F46849F67FD FOREIGN KEY (compagnie_assurance_id) REFERENCES compagnie_assurance (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F464F001650 FOREIGN KEY (mode_gestion_id) REFERENCES mode_gestion (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F462928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE compte ADD type_compte_id INT NOT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526046032730 FOREIGN KEY (type_compte_id) REFERENCES type_compte (id)');
        $this->addSql('CREATE INDEX IDX_CFF6526046032730 ON compte (type_compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526046032730');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB813AF326');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB2928752A');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB5DDD38F5');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499932928752A');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_6034999352FBE437');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993520D03A');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F46849F67FD');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F464F001650');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F462928752A');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE compagnie');
        $this->addSql('DROP TABLE compagnie_assurance');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE contrat_assurance_vie');
        $this->addSql('DROP TABLE mode_gestion');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE type_abonnement');
        $this->addSql('DROP TABLE type_compte');
        $this->addSql('DROP TABLE type_contrat');
        $this->addSql('DROP INDEX IDX_CFF6526046032730 ON compte');
        $this->addSql('ALTER TABLE compte DROP type_compte_id');
    }
}
