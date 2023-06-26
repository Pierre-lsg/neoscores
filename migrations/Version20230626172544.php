<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626172544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE target ADD spot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFC2DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_466F2FFC2DF1D37C ON target (spot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFC2DF1D37C');
        $this->addSql('DROP INDEX IDX_466F2FFC2DF1D37C ON target');
        $this->addSql('ALTER TABLE target DROP spot_id');
    }
}
