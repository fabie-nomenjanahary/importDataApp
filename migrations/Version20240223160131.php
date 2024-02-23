<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223160131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule ADD vendeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D858C065E ON vehicule (vendeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D858C065E');
        $this->addSql('DROP INDEX IDX_292FFF1D858C065E ON vehicule');
        $this->addSql('ALTER TABLE vehicule DROP vendeur_id');
    }
}
