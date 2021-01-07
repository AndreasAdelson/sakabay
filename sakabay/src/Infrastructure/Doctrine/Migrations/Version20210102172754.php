<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210102172754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_subscription (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant technique de la company_subscription\', id_subscription INT NOT NULL COMMENT \'Identifiant technique d\'\'un subscription\', id_company INT NOT NULL COMMENT \'Identifiant technique d\'\'un company\', dt_debut DATE DEFAULT NULL, dt_fin DATE DEFAULT NULL, INDEX IDX_5D0BAE1D800711A1 (id_subscription), INDEX IDX_5D0BAE1D9122A03F (id_company), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'Entité pour définir la validité de l\'\'abonnement.\' ');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant technique d\'\'un subscription\', name VARCHAR(191) NOT NULL, code VARCHAR(100) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'Entité représentant un Subscription.\' ');
        $this->addSql('ALTER TABLE company_subscription ADD CONSTRAINT FK_5D0BAE1D800711A1 FOREIGN KEY (id_subscription) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE company_subscription ADD CONSTRAINT FK_5D0BAE1D9122A03F FOREIGN KEY (id_company) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_subscription DROP FOREIGN KEY FK_5D0BAE1D800711A1');
        $this->addSql('DROP TABLE company_subscription');
        $this->addSql('DROP TABLE subscription');
    }
}
