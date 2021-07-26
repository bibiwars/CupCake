<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718114228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition (id_competition INT AUTO_INCREMENT NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, nom_competition VARCHAR(255) NOT NULL, PRIMARY KEY(id_competition)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, note INT NOT NULL, cible VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, idcompetition INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patisserie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel INT NOT NULL, idutilisateur INT NOT NULL, theme VARCHAR(255) NOT NULL, activer INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (ref_pdt INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix INT NOT NULL, image VARCHAR(255) NOT NULL, qte_stock INT NOT NULL, idpatisserie INT NOT NULL, note INT NOT NULL, PRIMARY KEY(ref_pdt)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id_publication INT AUTO_INCREMENT NOT NULL, idcompetition INT DEFAULT NULL, idutilisateur INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, texte VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id_publication)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id_reclamation INT AUTO_INCREMENT NOT NULL, imessage VARCHAR(255) NOT NULL, idutilisateur INT DEFAULT NULL, idpatisserie INT DEFAULT NULL, visible INT NOT NULL, status INT NOT NULL, reponse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id_reclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, tel VARCHAR(11) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, type VARCHAR(255) NOT NULL, activer TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE patisserie');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE utilisateur');
    }
}
