<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701082415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competition ADD competition_at DATE NOT NULL, ADD publishing_scores_at DATE NOT NULL, DROP date_start_competition, DROP date_scores_publishing');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competition ADD date_start_competition DATE NOT NULL, ADD date_scores_publishing DATE NOT NULL, DROP competition_at, DROP publishing_scores_at');
    }
}
