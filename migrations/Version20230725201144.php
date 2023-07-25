<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725201144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member ADD competition_fly_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78D3D9E44F FOREIGN KEY (competition_fly_id) REFERENCES competition_fly (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA78D3D9E44F ON member (competition_fly_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78D3D9E44F');
        $this->addSql('DROP INDEX IDX_70E4FA78D3D9E44F ON member');
        $this->addSql('ALTER TABLE member DROP competition_fly_id');
    }
}
