<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113165712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contrat_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_497DD6341823061F ON categorie (contrat_id)');
        $this->addSql('CREATE TABLE contrat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, autheur_id INTEGER NOT NULL, signature BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_60349993C6E59929 ON contrat (autheur_id)');
        $this->addSql('CREATE TABLE enfant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, u_parent_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, cagnotte INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34B70CA2E7927C74 ON enfant (email)');
        $this->addSql('CREATE INDEX IDX_34B70CA2389E4C46 ON enfant (u_parent_id)');
        $this->addSql('CREATE TABLE mission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, kins INTEGER NOT NULL, etat VARCHAR(255) NOT NULL, evaluation CLOB DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_9067F23CBCF5E72D ON mission (categorie_id)');
        $this->addSql('CREATE TABLE uparent (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AF70E11EE7927C74 ON uparent (email)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE uparent');
        $this->addSql('DROP TABLE user');
    }
}
