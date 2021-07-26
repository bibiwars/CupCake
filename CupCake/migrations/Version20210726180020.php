<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726180020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, iduser INT NOT NULL, message VARCHAR(255) NOT NULL, id_reclamation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD patisserie_id INT DEFAULT NULL, DROP idpatisserie');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC271031BC6E FOREIGN KEY (patisserie_id) REFERENCES patisserie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC271031BC6E ON produit (patisserie_id)');
        $this->addSql('ALTER TABLE publication DROP idutilisateur');
        $this->addSql('ALTER TABLE reclamation ADD type VARCHAR(255) NOT NULL, DROP idpatisserie, DROP visible, CHANGE status status VARCHAR(255) NOT NULL, CHANGE reponse reponse VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE avis');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC271031BC6E');
        $this->addSql('DROP INDEX IDX_29A5EC271031BC6E ON produit');
        $this->addSql('ALTER TABLE produit ADD idpatisserie INT NOT NULL, DROP patisserie_id');
        $this->addSql('ALTER TABLE publication ADD idutilisateur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD idpatisserie INT DEFAULT NULL, ADD visible INT NOT NULL, DROP type, CHANGE status status INT NOT NULL, CHANGE reponse reponse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
