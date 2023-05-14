<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230514163548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hole DROP FOREIGN KEY FK_68CD3D91744E0351');
        $this->addSql('DROP TABLE hole');
        $this->addSql('ALTER TABLE target ADD rule_id INT NOT NULL');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFC744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id)');
        $this->addSql('CREATE INDEX IDX_466F2FFC744E0351 ON target (rule_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hole (id INT AUTO_INCREMENT NOT NULL, rule_id INT NOT NULL, INDEX IDX_68CD3D91744E0351 (rule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE hole ADD CONSTRAINT FK_68CD3D91744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id)');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFC744E0351');
        $this->addSql('DROP INDEX IDX_466F2FFC744E0351 ON target');
        $this->addSql('ALTER TABLE target DROP rule_id');
    }
}
