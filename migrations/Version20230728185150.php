<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230728185150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, season VARCHAR(255) NOT NULL, is_internal TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, championship_id INT NOT NULL, golfcourse_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, competition_at DATE NOT NULL, publishing_scores_at DATE NOT NULL, nb_team_by_fly INT NOT NULL, nb_member_by_team INT NOT NULL, is_individual TINYINT(1) NOT NULL, INDEX IDX_B50A2CB194DDBCE9 (championship_id), INDEX IDX_B50A2CB11F10C409 (golfcourse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition_fly (id INT AUTO_INCREMENT NOT NULL, competition_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CB9CA3BB7B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE global_parameter (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE golf_course (id INT AUTO_INCREMENT NOT NULL, spot_id INT DEFAULT NULL, number_of_targets INT NOT NULL, is_completed TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EC96E1622DF1D37C (spot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE golf_course_target (golf_course_id INT NOT NULL, target_id INT NOT NULL, INDEX IDX_BC8271A4731B2E4E (golf_course_id), INDEX IDX_BC8271A4158E0B66 (target_id), PRIMARY KEY(golf_course_id, target_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, team_id INT DEFAULT NULL, competition_fly_id INT DEFAULT NULL, championship_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, nick_name VARCHAR(255) DEFAULT NULL, INDEX IDX_70E4FA7861190A32 (club_id), INDEX IDX_70E4FA78296CD8AE (team_id), INDEX IDX_70E4FA78D3D9E44F (competition_fly_id), INDEX IDX_70E4FA7894DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE target (id INT AUTO_INCREMENT NOT NULL, rule_id INT NOT NULL, spot_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, par INT NOT NULL, INDEX IDX_466F2FFC744E0351 (rule_id), INDEX IDX_466F2FFC2DF1D37C (spot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, competition_fly_id INT DEFAULT NULL, championship_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_C4E0A61F61190A32 (club_id), INDEX IDX_C4E0A61FD3D9E44F (competition_fly_id), INDEX IDX_C4E0A61F94DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB194DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB11F10C409 FOREIGN KEY (golfcourse_id) REFERENCES golf_course (id)');
        $this->addSql('ALTER TABLE competition_fly ADD CONSTRAINT FK_CB9CA3BB7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE golf_course ADD CONSTRAINT FK_EC96E1622DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE golf_course_target ADD CONSTRAINT FK_BC8271A4731B2E4E FOREIGN KEY (golf_course_id) REFERENCES golf_course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE golf_course_target ADD CONSTRAINT FK_BC8271A4158E0B66 FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA7861190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78D3D9E44F FOREIGN KEY (competition_fly_id) REFERENCES competition_fly (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA7894DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFC744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id)');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFC2DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FD3D9E44F FOREIGN KEY (competition_fly_id) REFERENCES competition_fly (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F94DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB194DDBCE9');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB11F10C409');
        $this->addSql('ALTER TABLE competition_fly DROP FOREIGN KEY FK_CB9CA3BB7B39D312');
        $this->addSql('ALTER TABLE golf_course DROP FOREIGN KEY FK_EC96E1622DF1D37C');
        $this->addSql('ALTER TABLE golf_course_target DROP FOREIGN KEY FK_BC8271A4731B2E4E');
        $this->addSql('ALTER TABLE golf_course_target DROP FOREIGN KEY FK_BC8271A4158E0B66');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA7861190A32');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78296CD8AE');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78D3D9E44F');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA7894DDBCE9');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFC744E0351');
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFC2DF1D37C');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F61190A32');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FD3D9E44F');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F94DDBCE9');
        $this->addSql('DROP TABLE championship');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE competition_fly');
        $this->addSql('DROP TABLE global_parameter');
        $this->addSql('DROP TABLE golf_course');
        $this->addSql('DROP TABLE golf_course_target');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE spot');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
