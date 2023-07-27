<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727195846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member ADD championship_id INT NOT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA7894DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA7894DDBCE9 ON member (championship_id)');
        $this->addSql('ALTER TABLE team ADD championship_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F94DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F94DDBCE9 ON team (championship_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F94DDBCE9');
        $this->addSql('DROP INDEX IDX_C4E0A61F94DDBCE9 ON team');
        $this->addSql('ALTER TABLE team DROP championship_id');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA7894DDBCE9');
        $this->addSql('DROP INDEX IDX_70E4FA7894DDBCE9 ON member');
        $this->addSql('ALTER TABLE member DROP championship_id');
    }
}
