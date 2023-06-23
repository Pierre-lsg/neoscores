<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623173444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE golf_course (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE golf_course_target (golf_course_id INT NOT NULL, target_id INT NOT NULL, INDEX IDX_BC8271A4731B2E4E (golf_course_id), INDEX IDX_BC8271A4158E0B66 (target_id), PRIMARY KEY(golf_course_id, target_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE golf_course_target ADD CONSTRAINT FK_BC8271A4731B2E4E FOREIGN KEY (golf_course_id) REFERENCES golf_course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE golf_course_target ADD CONSTRAINT FK_BC8271A4158E0B66 FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE golf_course_target DROP FOREIGN KEY FK_BC8271A4731B2E4E');
        $this->addSql('ALTER TABLE golf_course_target DROP FOREIGN KEY FK_BC8271A4158E0B66');
        $this->addSql('DROP TABLE golf_course');
        $this->addSql('DROP TABLE golf_course_target');
    }
}
