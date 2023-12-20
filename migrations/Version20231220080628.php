<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220080628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jedi_guerre (jedi_id INT NOT NULL, guerre_id INT NOT NULL, INDEX IDX_AA1B27F3590F271A (jedi_id), INDEX IDX_AA1B27F3B3350003 (guerre_id), PRIMARY KEY(jedi_id, guerre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jedi_guerre ADD CONSTRAINT FK_AA1B27F3590F271A FOREIGN KEY (jedi_id) REFERENCES jedi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jedi_guerre ADD CONSTRAINT FK_AA1B27F3B3350003 FOREIGN KEY (guerre_id) REFERENCES guerre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jedi_guerre DROP FOREIGN KEY FK_AA1B27F3590F271A');
        $this->addSql('ALTER TABLE jedi_guerre DROP FOREIGN KEY FK_AA1B27F3B3350003');
        $this->addSql('DROP TABLE jedi_guerre');
    }
}
