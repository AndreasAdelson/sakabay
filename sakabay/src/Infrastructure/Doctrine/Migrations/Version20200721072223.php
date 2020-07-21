<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200721072223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE example_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE example (id INT NOT NULL, nom VARCHAR(100) DEFAULT NULL, consigne VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE example IS \'Example d\'\'un crud.\'');
        $this->addSql('COMMENT ON COLUMN example.id IS \'Identifiant technique d\'\'un example\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, nom VARCHAR(100) DEFAULT NULL, prenom VARCHAR(200) DEFAULT NULL, login VARCHAR(300) DEFAULT NULL, email VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE "user" IS \'Entité représentant un user\'');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'Identifiant technique d\'\'un user\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE example_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE example');
        $this->addSql('DROP TABLE "user"');
    }
}
