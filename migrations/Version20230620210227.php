<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620210227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competition ADD championship_id INT NOT NULL');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB194DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('CREATE INDEX IDX_B50A2CB194DDBCE9 ON competition (championship_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB194DDBCE9');
        $this->addSql('DROP INDEX IDX_B50A2CB194DDBCE9 ON competition');
        $this->addSql('ALTER TABLE competition DROP championship_id');
    }
}
