<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113173707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_497DD6341823061F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categorie AS SELECT id, contrat_id, nom, couleur FROM categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contrat_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, couleur VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_497DD6341823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO categorie (id, contrat_id, nom, couleur) SELECT id, contrat_id, nom, couleur FROM __temp__categorie');
        $this->addSql('DROP TABLE __temp__categorie');
        $this->addSql('CREATE INDEX IDX_497DD6341823061F ON categorie (contrat_id)');
        $this->addSql('DROP INDEX IDX_60349993C6E59929');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contrat AS SELECT id, autheur_id, signature FROM contrat');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('CREATE TABLE contrat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, autheur_id INTEGER NOT NULL, signature BOOLEAN NOT NULL, CONSTRAINT FK_60349993C6E59929 FOREIGN KEY (autheur_id) REFERENCES uparent (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO contrat (id, autheur_id, signature) SELECT id, autheur_id, signature FROM __temp__contrat');
        $this->addSql('DROP TABLE __temp__contrat');
        $this->addSql('CREATE INDEX IDX_60349993C6E59929 ON contrat (autheur_id)');
        $this->addSql('DROP INDEX IDX_34B70CA2389E4C46');
        $this->addSql('DROP INDEX UNIQ_34B70CA2E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__enfant AS SELECT id, u_parent_id, email, roles, password, cagnotte FROM enfant');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('CREATE TABLE enfant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, u_parent_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , password VARCHAR(255) NOT NULL COLLATE BINARY, cagnotte INTEGER NOT NULL, CONSTRAINT FK_34B70CA2389E4C46 FOREIGN KEY (u_parent_id) REFERENCES uparent (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO enfant (id, u_parent_id, email, roles, password, cagnotte) SELECT id, u_parent_id, email, roles, password, cagnotte FROM __temp__enfant');
        $this->addSql('DROP TABLE __temp__enfant');
        $this->addSql('CREATE INDEX IDX_34B70CA2389E4C46 ON enfant (u_parent_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34B70CA2E7927C74 ON enfant (email)');
        $this->addSql('DROP INDEX IDX_9067F23CBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mission AS SELECT id, categorie_id, titre, kins, etat, evaluation FROM mission');
        $this->addSql('DROP TABLE mission');
        $this->addSql('CREATE TABLE mission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL COLLATE BINARY, kins INTEGER NOT NULL, etat VARCHAR(255) NOT NULL COLLATE BINARY, evaluation CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_9067F23CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO mission (id, categorie_id, titre, kins, etat, evaluation) SELECT id, categorie_id, titre, kins, etat, evaluation FROM __temp__mission');
        $this->addSql('DROP TABLE __temp__mission');
        $this->addSql('CREATE INDEX IDX_9067F23CBCF5E72D ON mission (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_497DD6341823061F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categorie AS SELECT id, contrat_id, nom, couleur FROM categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contrat_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO categorie (id, contrat_id, nom, couleur) SELECT id, contrat_id, nom, couleur FROM __temp__categorie');
        $this->addSql('DROP TABLE __temp__categorie');
        $this->addSql('CREATE INDEX IDX_497DD6341823061F ON categorie (contrat_id)');
        $this->addSql('DROP INDEX IDX_60349993C6E59929');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contrat AS SELECT id, autheur_id, signature FROM contrat');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('CREATE TABLE contrat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, autheur_id INTEGER NOT NULL, signature BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO contrat (id, autheur_id, signature) SELECT id, autheur_id, signature FROM __temp__contrat');
        $this->addSql('DROP TABLE __temp__contrat');
        $this->addSql('CREATE INDEX IDX_60349993C6E59929 ON contrat (autheur_id)');
        $this->addSql('DROP INDEX UNIQ_34B70CA2E7927C74');
        $this->addSql('DROP INDEX IDX_34B70CA2389E4C46');
        $this->addSql('CREATE TEMPORARY TABLE __temp__enfant AS SELECT id, u_parent_id, email, roles, password, cagnotte FROM enfant');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('CREATE TABLE enfant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, u_parent_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, cagnotte INTEGER NOT NULL)');
        $this->addSql('INSERT INTO enfant (id, u_parent_id, email, roles, password, cagnotte) SELECT id, u_parent_id, email, roles, password, cagnotte FROM __temp__enfant');
        $this->addSql('DROP TABLE __temp__enfant');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34B70CA2E7927C74 ON enfant (email)');
        $this->addSql('CREATE INDEX IDX_34B70CA2389E4C46 ON enfant (u_parent_id)');
        $this->addSql('DROP INDEX IDX_9067F23CBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mission AS SELECT id, categorie_id, titre, kins, etat, evaluation FROM mission');
        $this->addSql('DROP TABLE mission');
        $this->addSql('CREATE TABLE mission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, kins INTEGER NOT NULL, etat VARCHAR(255) NOT NULL, evaluation CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO mission (id, categorie_id, titre, kins, etat, evaluation) SELECT id, categorie_id, titre, kins, etat, evaluation FROM __temp__mission');
        $this->addSql('DROP TABLE __temp__mission');
        $this->addSql('CREATE INDEX IDX_9067F23CBCF5E72D ON mission (categorie_id)');
    }
}
