<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240723094400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD team_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638296CD8AE FOREIGN KEY (team_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638296CD8AE ON contact (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638296CD8AE');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP INDEX IDX_4C62E638296CD8AE ON contact');
        $this->addSql('ALTER TABLE contact DROP team_id');
    }
}
