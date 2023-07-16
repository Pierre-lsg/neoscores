<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230716111124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competition_fly (id INT AUTO_INCREMENT NOT NULL, competition_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CB9CA3BB7B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition_fly ADD CONSTRAINT FK_CB9CA3BB7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE team ADD competition_fly_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FD3D9E44F FOREIGN KEY (competition_fly_id) REFERENCES competition_fly (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FD3D9E44F ON team (competition_fly_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FD3D9E44F');
        $this->addSql('ALTER TABLE competition_fly DROP FOREIGN KEY FK_CB9CA3BB7B39D312');
        $this->addSql('DROP TABLE competition_fly');
        $this->addSql('DROP INDEX IDX_C4E0A61FD3D9E44F ON team');
        $this->addSql('ALTER TABLE team DROP competition_fly_id');
    }
}
