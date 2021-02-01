<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203130527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD description_full VARCHAR(5000) DEFAULT NULL, CHANGE description description_clean VARCHAR(2000) DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_category CHANGE id_category id_category INT NOT NULL COMMENT \'Identifiant technique d\'\'un category\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP description_full, CHANGE description_clean description VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sous_category CHANGE id_category id_category INT DEFAULT NULL COMMENT \'Identifiant technique d\'\'un category\'');
    }
}
