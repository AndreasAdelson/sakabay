<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200727132904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE example_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fonction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE groupe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE example (id INT NOT NULL, nom VARCHAR(100) DEFAULT NULL, consigne VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE example IS \'Example d\'\'un crud.\'');
        $this->addSql('COMMENT ON COLUMN example.id IS \'Identifiant technique d\'\'un example\'');
        $this->addSql('CREATE TABLE fonction (id INT NOT NULL, code VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniqueFonctionCode ON fonction (code)');
        $this->addSql('COMMENT ON TABLE fonction IS \'Entité technique regroupant les fonctions de l\'\'application. On associe une fonction à un rôle pour donner à ce rôle les droits sur cette fonction.\'');
        $this->addSql('COMMENT ON COLUMN fonction.id IS \'Identifiant technique de la fonction\'');
        $this->addSql('COMMENT ON COLUMN fonction.code IS \'Code de la fonction\'');
        $this->addSql('COMMENT ON COLUMN fonction.description IS \'Nom de la fonction\'');
        $this->addSql('CREATE TABLE groupe (id INT NOT NULL, name VARCHAR(50) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniqueGroupCode ON "groupe" (code)');
        $this->addSql('COMMENT ON TABLE "groupe" IS \'Entité technique regroupant les rôles de l\'\'application. On associe un utilisateur à un groupe pour donner à cet utilisateur les droits du groupe.\'');
        $this->addSql('COMMENT ON COLUMN "groupe".id IS \'Identifiant technique de la group\'');
        $this->addSql('COMMENT ON COLUMN "groupe".name IS \'Nom du groupe\'');
        $this->addSql('COMMENT ON COLUMN "groupe".code IS \'Code du groupe\'');
        $this->addSql('CREATE TABLE groupes_roles (id_group INT NOT NULL, id_role INT NOT NULL, PRIMARY KEY(id_group, id_role))');
        $this->addSql('CREATE INDEX IDX_5F256D89834505F5 ON groupes_roles (id_group)');
        $this->addSql('CREATE INDEX IDX_5F256D89DC499668 ON groupes_roles (id_role)');
        $this->addSql('COMMENT ON COLUMN groupes_roles.id_group IS \'Identifiant technique d\'\'un group\'');
        $this->addSql('COMMENT ON COLUMN groupes_roles.id_role IS \'Identifiant technique d\'\'un role\'');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(300) NOT NULL, code VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE role IS \'Entité représentant un Role.\'');
        $this->addSql('COMMENT ON COLUMN role.id IS \'Identifiant technique d\'\'un role\'');
        $this->addSql('CREATE TABLE roles_fontions (id_role INT NOT NULL, id_fonction INT NOT NULL, PRIMARY KEY(id_role, id_fonction))');
        $this->addSql('CREATE INDEX IDX_2D7645A5DC499668 ON roles_fontions (id_role)');
        $this->addSql('CREATE INDEX IDX_2D7645A559DB3928 ON roles_fontions (id_fonction)');
        $this->addSql('COMMENT ON COLUMN roles_fontions.id_role IS \'Identifiant technique d\'\'un role\'');
        $this->addSql('COMMENT ON COLUMN roles_fontions.id_fonction IS \'Identifiant technique de la fonction\'');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, login VARCHAR(300) NOT NULL, email VARCHAR(300) NOT NULL, first_name VARCHAR(300) NOT NULL, password VARCHAR(300) NOT NULL, last_name VARCHAR(300) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniqueUtilisateurLogin ON "utilisateur" (login)');
        $this->addSql('CREATE UNIQUE INDEX uniqueUtilisateurEmail ON "utilisateur" (email)');
        $this->addSql('COMMENT ON TABLE utilisateur IS \'Entité représentant un user\'');
        $this->addSql('COMMENT ON COLUMN utilisateur.id IS \'Identifiant technique d\'\'un user\'');
        $this->addSql('CREATE TABLE utilisateurs_groupes (id_user INT NOT NULL, id_group INT NOT NULL, PRIMARY KEY(id_user, id_group))');
        $this->addSql('CREATE INDEX IDX_59950F8C6B3CA4B ON utilisateurs_groupes (id_user)');
        $this->addSql('CREATE INDEX IDX_59950F8C834505F5 ON utilisateurs_groupes (id_group)');
        $this->addSql('COMMENT ON COLUMN utilisateurs_groupes.id_user IS \'Identifiant technique d\'\'un user\'');
        $this->addSql('COMMENT ON COLUMN utilisateurs_groupes.id_group IS \'Identifiant technique de la group\'');
        $this->addSql('ALTER TABLE groupes_roles ADD CONSTRAINT FK_5F256D89834505F5 FOREIGN KEY (id_group) REFERENCES "groupe" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groupes_roles ADD CONSTRAINT FK_5F256D89DC499668 FOREIGN KEY (id_role) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roles_fontions ADD CONSTRAINT FK_2D7645A5DC499668 FOREIGN KEY (id_role) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roles_fontions ADD CONSTRAINT FK_2D7645A559DB3928 FOREIGN KEY (id_fonction) REFERENCES fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateurs_groupes ADD CONSTRAINT FK_59950F8C6B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateurs_groupes ADD CONSTRAINT FK_59950F8C834505F5 FOREIGN KEY (id_group) REFERENCES "groupe" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roles_fontions DROP CONSTRAINT FK_2D7645A559DB3928');
        $this->addSql('ALTER TABLE groupes_roles DROP CONSTRAINT FK_5F256D89834505F5');
        $this->addSql('ALTER TABLE utilisateurs_groupes DROP CONSTRAINT FK_59950F8C834505F5');
        $this->addSql('ALTER TABLE groupes_roles DROP CONSTRAINT FK_5F256D89DC499668');
        $this->addSql('ALTER TABLE roles_fontions DROP CONSTRAINT FK_2D7645A5DC499668');
        $this->addSql('ALTER TABLE utilisateurs_groupes DROP CONSTRAINT FK_59950F8C6B3CA4B');
        $this->addSql('DROP SEQUENCE example_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fonction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE groupe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE utilisateur_id_seq CASCADE');
        $this->addSql('DROP TABLE example');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupes_roles');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE roles_fontions');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateurs_groupes');
    }
}
