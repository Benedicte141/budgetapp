<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116073302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, type_abonnement_id INT DEFAULT NULL, periodicite_id INT DEFAULT NULL, organisme_id INT DEFAULT NULL, numero_client VARCHAR(255) NOT NULL, date_souscription DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, objet VARCHAR(255) DEFAULT NULL, INDEX IDX_351268BB813AF326 (type_abonnement_id), INDEX IDX_351268BB2928752A (periodicite_id), INDEX IDX_351268BB5DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie_assurance (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, banque_id INT NOT NULL, type_compte_id INT NOT NULL, numero VARCHAR(25) NOT NULL, nom VARCHAR(30) NOT NULL, solde DOUBLE PRECISION NOT NULL, INDEX IDX_CFF6526037E080D9 (banque_id), INDEX IDX_CFF6526046032730 (type_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, periodicite_id INT DEFAULT NULL, compagnie_id INT DEFAULT NULL, type_contrat_id INT DEFAULT NULL, date_sous DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, libelle_couverture VARCHAR(255) NOT NULL, num_client VARCHAR(255) NOT NULL, INDEX IDX_603499932928752A (periodicite_id), INDEX IDX_6034999352FBE437 (compagnie_id), INDEX IDX_60349993520D03A (type_contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat_assurance_vie (id INT AUTO_INCREMENT NOT NULL, compagnie_assurance_id INT NOT NULL, mode_gestion_id INT NOT NULL, periodicite_id INT DEFAULT NULL, solde NUMERIC(15, 2) NOT NULL, montant_value_latente NUMERIC(15, 2) NOT NULL, total_investit NUMERIC(15, 2) NOT NULL, numero VARCHAR(50) NOT NULL, total_rachete NUMERIC(15, 2) NOT NULL, date_ouverture DATE NOT NULL, montant_versement_libre NUMERIC(15, 2) DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_964C7F46849F67FD (compagnie_assurance_id), INDEX IDX_964C7F464F001650 (mode_gestion_id), INDEX IDX_964C7F462928752A (periodicite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, periodicite_id INT NOT NULL, type_emprunt_id INT NOT NULL, banque_id INT NOT NULL, montant_initial DOUBLE PRECISION NOT NULL, montant_echeance DOUBLE PRECISION NOT NULL, cout_interet DOUBLE PRECISION NOT NULL, montant_rest_du DOUBLE PRECISION DEFAULT NULL, date_deb DATE NOT NULL, taux DOUBLE PRECISION NOT NULL, objet VARCHAR(255) NOT NULL, duree INT NOT NULL, INDEX IDX_364071D72928752A (periodicite_id), INDEX IDX_364071D7B37C39B1 (type_emprunt_id), INDEX IDX_364071D737E080D9 (banque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_gestion (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, compte_id INT DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, libelle VARCHAR(25) DEFAULT NULL, INDEX IDX_1981A66DF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periodicite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, budget_mensuel DOUBLE PRECISION DEFAULT NULL, budget_annuel DOUBLE PRECISION DEFAULT NULL, INDEX IDX_52743D7BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_abonnement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_compte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contrat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_emprunt (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, civilite VARCHAR(15) NOT NULL, cp VARCHAR(5) NOT NULL, pays VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB813AF326 FOREIGN KEY (type_abonnement_id) REFERENCES type_abonnement (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB2928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526037E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526046032730 FOREIGN KEY (type_compte_id) REFERENCES type_compte (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499932928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_6034999352FBE437 FOREIGN KEY (compagnie_id) REFERENCES compagnie (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993520D03A FOREIGN KEY (type_contrat_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F46849F67FD FOREIGN KEY (compagnie_assurance_id) REFERENCES compagnie_assurance (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F464F001650 FOREIGN KEY (mode_gestion_id) REFERENCES mode_gestion (id)');
        $this->addSql('ALTER TABLE contrat_assurance_vie ADD CONSTRAINT FK_964C7F462928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D72928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7B37C39B1 FOREIGN KEY (type_emprunt_id) REFERENCES type_emprunt (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D737E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB813AF326');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB2928752A');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB5DDD38F5');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526037E080D9');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526046032730');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499932928752A');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_6034999352FBE437');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993520D03A');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F46849F67FD');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F464F001650');
        $this->addSql('ALTER TABLE contrat_assurance_vie DROP FOREIGN KEY FK_964C7F462928752A');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D72928752A');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7B37C39B1');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D737E080D9');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66DF2C56620');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE banque');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE compagnie');
        $this->addSql('DROP TABLE compagnie_assurance');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE contrat_assurance_vie');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE mode_gestion');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE periodicite');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE type_abonnement');
        $this->addSql('DROP TABLE type_compte');
        $this->addSql('DROP TABLE type_contrat');
        $this->addSql('DROP TABLE type_emprunt');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
