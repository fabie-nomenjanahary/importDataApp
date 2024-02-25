<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240225011502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, voie VARCHAR(70) DEFAULT NULL, code_postal VARCHAR(5) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, complement_adr VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, compte_affaire VARCHAR(20) DEFAULT NULL, compte_event VARCHAR(20) DEFAULT NULL, dernier_event VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, tel_domicile VARCHAR(14) DEFAULT NULL, tel_portable VARCHAR(10) DEFAULT NULL, tel_job VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, origine_event VARCHAR(20) DEFAULT NULL, commentaire VARCHAR(50) DEFAULT NULL, date_event DATE DEFAULT NULL, date_dernier_event DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, surnom VARCHAR(100) DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, civilite VARCHAR(3) DEFAULT NULL, INDEX IDX_69E399D64DE7DC5C (adresse_id), INDEX IDX_69E399D6E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, compte_id INT DEFAULT NULL, vendeur_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, numero_fiche VARCHAR(5) DEFAULT NULL, date_circul DATE DEFAULT NULL, date_achat DATE DEFAULT NULL, marque VARCHAR(20) DEFAULT NULL, modele VARCHAR(20) DEFAULT NULL, version VARCHAR(50) DEFAULT NULL, vin VARCHAR(50) DEFAULT NULL, matricule VARCHAR(12) DEFAULT NULL, prospect VARCHAR(12) DEFAULT NULL, kilometrage INT DEFAULT NULL, energie VARCHAR(20) DEFAULT NULL, type_vehicule VARCHAR(2) DEFAULT NULL, numero_dossier VARCHAR(10) DEFAULT NULL, INDEX IDX_292FFF1D76C50E4A (proprietaire_id), INDEX IDX_292FFF1DF2C56620 (compte_id), INDEX IDX_292FFF1D858C065E (vendeur_id), INDEX IDX_292FFF1DFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, vendeur_vo VARCHAR(50) DEFAULT NULL, vendeur_vn VARCHAR(50) DEFAULT NULL, intermediaire VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proprietaire ADD CONSTRAINT FK_69E399D64DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE proprietaire ADD CONSTRAINT FK_69E399D6E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D64DE7DC5C');
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D6E7A1254A');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D76C50E4A');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DF2C56620');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D858C065E');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DFD02F13');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE vendeur');
    }
}
