<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230731191012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club ADD championship_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387294DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('CREATE INDEX IDX_B8EE387294DDBCE9 ON club (championship_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387294DDBCE9');
        $this->addSql('DROP INDEX IDX_B8EE387294DDBCE9 ON club');
        $this->addSql('ALTER TABLE club DROP championship_id');
    }
}
