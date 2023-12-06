<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206084100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guerre (id INT AUTO_INCREMENT NOT NULL, planete VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jedi (id INT AUTO_INCREMENT NOT NULL, padawan_id INT DEFAULT NULL, legion_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E3CB6EFD7376E8F (padawan_id), INDEX IDX_E3CB6EFFC2498B6 (legion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jedi_guerre (jedi_id INT NOT NULL, guerre_id INT NOT NULL, INDEX IDX_AA1B27F3590F271A (jedi_id), INDEX IDX_AA1B27F3B3350003 (guerre_id), PRIMARY KEY(jedi_id, guerre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legion (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, commandant VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE padawan (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sabre (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, couleur VARCHAR(255) NOT NULL, bi_lame TINYINT(1) NOT NULL, INDEX IDX_90486C8976C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_force (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFD7376E8F FOREIGN KEY (padawan_id) REFERENCES padawan (id)');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFFC2498B6 FOREIGN KEY (legion_id) REFERENCES legion (id)');
        $this->addSql('ALTER TABLE jedi_guerre ADD CONSTRAINT FK_AA1B27F3590F271A FOREIGN KEY (jedi_id) REFERENCES jedi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jedi_guerre ADD CONSTRAINT FK_AA1B27F3B3350003 FOREIGN KEY (guerre_id) REFERENCES guerre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sabre ADD CONSTRAINT FK_90486C8976C50E4A FOREIGN KEY (proprietaire_id) REFERENCES utilisateur_force (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFD7376E8F');
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFFC2498B6');
        $this->addSql('ALTER TABLE jedi_guerre DROP FOREIGN KEY FK_AA1B27F3590F271A');
        $this->addSql('ALTER TABLE jedi_guerre DROP FOREIGN KEY FK_AA1B27F3B3350003');
        $this->addSql('ALTER TABLE sabre DROP FOREIGN KEY FK_90486C8976C50E4A');
        $this->addSql('DROP TABLE guerre');
        $this->addSql('DROP TABLE jedi');
        $this->addSql('DROP TABLE jedi_guerre');
        $this->addSql('DROP TABLE legion');
        $this->addSql('DROP TABLE padawan');
        $this->addSql('DROP TABLE sabre');
        $this->addSql('DROP TABLE utilisateur_force');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
