<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128165104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_sous_categories (company_id INT NOT NULL COMMENT \'Identifiant technique d\'\'un company\', id_company INT NOT NULL COMMENT \'Identifiant technique d\'\'une sous category\', INDEX IDX_937A29FF979B1AD6 (company_id), INDEX IDX_937A29FF9122A03F (id_company), PRIMARY KEY(company_id, id_company)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_category (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant technique d\'\'une sous category\', id_category INT NOT NULL COMMENT \'Identifiant technique d\'\'un category\', name VARCHAR(191) NOT NULL, code VARCHAR(100) NOT NULL, INDEX IDX_E022D945697F554 (id_category), UNIQUE INDEX uniqueGroupCode (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'Entité représentant un SousCategory.\' ');
        $this->addSql('ALTER TABLE company_sous_categories ADD CONSTRAINT FK_937A29FF979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_sous_categories ADD CONSTRAINT FK_937A29FF9122A03F FOREIGN KEY (id_company) REFERENCES sous_category (id)');
        $this->addSql('ALTER TABLE sous_category ADD CONSTRAINT FK_E022D945697F554 FOREIGN KEY (id_category) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX uniqueGroupCode ON category (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_sous_categories DROP FOREIGN KEY FK_937A29FF9122A03F');
        $this->addSql('DROP TABLE company_sous_categories');
        $this->addSql('DROP TABLE sous_category');
        $this->addSql('DROP INDEX uniqueGroupCode ON category');
    }
}
