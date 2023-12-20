<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220080921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jedi (id INT NOT NULL, padawan_id INT DEFAULT NULL, legion_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E3CB6EFD7376E8F (padawan_id), INDEX IDX_E3CB6EFFC2498B6 (legion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jedi_guerre (jedi_id INT NOT NULL, guerre_id INT NOT NULL, INDEX IDX_AA1B27F3590F271A (jedi_id), INDEX IDX_AA1B27F3B3350003 (guerre_id), PRIMARY KEY(jedi_id, guerre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFD7376E8F FOREIGN KEY (padawan_id) REFERENCES padawan (id)');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFFC2498B6 FOREIGN KEY (legion_id) REFERENCES legion (id)');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFBF396750 FOREIGN KEY (id) REFERENCES utilisateur_force (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jedi_guerre ADD CONSTRAINT FK_AA1B27F3590F271A FOREIGN KEY (jedi_id) REFERENCES jedi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jedi_guerre ADD CONSTRAINT FK_AA1B27F3B3350003 FOREIGN KEY (guerre_id) REFERENCES guerre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFD7376E8F');
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFFC2498B6');
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFBF396750');
        $this->addSql('ALTER TABLE jedi_guerre DROP FOREIGN KEY FK_AA1B27F3590F271A');
        $this->addSql('ALTER TABLE jedi_guerre DROP FOREIGN KEY FK_AA1B27F3B3350003');
        $this->addSql('DROP TABLE jedi');
        $this->addSql('DROP TABLE jedi_guerre');
    }
}
