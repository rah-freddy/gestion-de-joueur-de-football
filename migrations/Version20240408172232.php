<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408172232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club_team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE national_team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, club_team_id INT DEFAULT NULL, national_team_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, course LONGTEXT NOT NULL, goals_number INT NOT NULL, birth_date DATE NOT NULL, INDEX IDX_98197A6524247D2C (club_team_id), INDEX IDX_98197A659008F799 (national_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6524247D2C FOREIGN KEY (club_team_id) REFERENCES club_team (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A659008F799 FOREIGN KEY (national_team_id) REFERENCES national_team (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6524247D2C');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A659008F799');
        $this->addSql('DROP TABLE club_team');
        $this->addSql('DROP TABLE national_team');
        $this->addSql('DROP TABLE player');
    }
}
