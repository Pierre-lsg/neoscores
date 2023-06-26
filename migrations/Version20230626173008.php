<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626173008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE golf_course ADD spot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE golf_course ADD CONSTRAINT FK_EC96E1622DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_EC96E1622DF1D37C ON golf_course (spot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE golf_course DROP FOREIGN KEY FK_EC96E1622DF1D37C');
        $this->addSql('DROP INDEX IDX_EC96E1622DF1D37C ON golf_course');
        $this->addSql('ALTER TABLE golf_course DROP spot_id');
    }
}
