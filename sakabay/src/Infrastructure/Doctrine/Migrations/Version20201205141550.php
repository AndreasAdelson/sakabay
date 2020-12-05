<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201205141550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant technique d\'\'un city\', name VARCHAR(191) NOT NULL, UNIQUE INDEX uniqueGroupCode (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'Entité représentant une adresse.\' ');
        $this->addSql('ALTER TABLE company ADD id_city INT NOT NULL COMMENT \'Identifiant technique d\'\'un city\'');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA67B1E36 FOREIGN KEY (id_city) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FA67B1E36 ON company (id_city)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA67B1E36');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP INDEX IDX_4FBF094FA67B1E36 ON company');
        $this->addSql('ALTER TABLE company DROP id_city');
    }
}
