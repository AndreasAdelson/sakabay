<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111171354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant technique d\'\'un mot de passe oublié\', id_utilisateur INT NOT NULL COMMENT \'Identifiant technique d\'\'un user\', expires_at DATETIME DEFAULT NULL, requested_at DATETIME DEFAULT NULL, selector VARCHAR(20) DEFAULT NULL, hashed_token VARCHAR(100) DEFAULT NULL, INDEX IDX_B9983CE550EAE44 (id_utilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'Entité représentant un mot de passe oublié.\' ');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE550EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password');
    }
}
