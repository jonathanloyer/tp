<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241023143805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD98EA1EBC33');
        $this->addSql('CREATE TABLE list_taches (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE todo_list');
        $this->addSql('DROP INDEX IDX_3BF2CD98EA1EBC33 ON taches');
        $this->addSql('ALTER TABLE taches CHANGE todo_id list_tache_id INT DEFAULT NULL, CHANGE nom title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD98AC4E6E59 FOREIGN KEY (list_tache_id) REFERENCES list_taches (id)');
        $this->addSql('CREATE INDEX IDX_3BF2CD98AC4E6E59 ON taches (list_tache_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD98AC4E6E59');
        $this->addSql('CREATE TABLE todo_list (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE list_taches');
        $this->addSql('DROP INDEX IDX_3BF2CD98AC4E6E59 ON taches');
        $this->addSql('ALTER TABLE taches CHANGE list_tache_id todo_id INT DEFAULT NULL, CHANGE title nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD98EA1EBC33 FOREIGN KEY (todo_id) REFERENCES todo_list (id)');
        $this->addSql('CREATE INDEX IDX_3BF2CD98EA1EBC33 ON taches (todo_id)');
    }
}
