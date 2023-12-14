<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214071210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jedi ADD padawan_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFD7376E8F FOREIGN KEY (padawan_id) REFERENCES padawan (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E3CB6EFD7376E8F ON jedi (padawan_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFD7376E8F');
        $this->addSql('DROP INDEX UNIQ_E3CB6EFD7376E8F ON jedi');
        $this->addSql('ALTER TABLE jedi DROP padawan_id');
    }
}
