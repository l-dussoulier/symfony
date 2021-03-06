<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221141013 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE V_Materiel (Id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, Categorie VARCHAR(50) NOT NULL, Marque VARCHAR(50) NOT NULL, Etat VARCHAR(50) NOT NULL, PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE Id Id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE Materiel CHANGE Categorie Categorie INT DEFAULT NULL, CHANGE Etat Etat INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE password password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE V_Materiel');
        $this->addSql('ALTER TABLE Materiel CHANGE Categorie Categorie INT NOT NULL, CHANGE Etat Etat INT NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE Id Id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', CHANGE password password VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
