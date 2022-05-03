<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503105400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recompense (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, cout INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recompense_user (recompense_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B539E1A24D714096 (recompense_id), INDEX IDX_B539E1A2A76ED395 (user_id), PRIMARY KEY(recompense_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recompense_user ADD CONSTRAINT FK_B539E1A24D714096 FOREIGN KEY (recompense_id) REFERENCES recompense (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recompense_user ADD CONSTRAINT FK_B539E1A2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6341823061F');
        $this->addSql('DROP INDEX IDX_497DD6341823061F ON categorie');
        $this->addSql('ALTER TABLE categorie DROP contrat_id');
        $this->addSql('ALTER TABLE contrat ADD signature_parent TINYINT(1) DEFAULT NULL, ADD signature_enfant TINYINT(1) DEFAULT NULL, DROP signature');
        $this->addSql('ALTER TABLE mission ADD auto_evaluation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD kins INT DEFAULT NULL, ADD points_bonus INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recompense_user DROP FOREIGN KEY FK_B539E1A24D714096');
        $this->addSql('DROP TABLE recompense');
        $this->addSql('DROP TABLE recompense_user');
        $this->addSql('ALTER TABLE categorie ADD contrat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6341823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id)');
        $this->addSql('CREATE INDEX IDX_497DD6341823061F ON categorie (contrat_id)');
        $this->addSql('ALTER TABLE contrat ADD signature TINYINT(1) NOT NULL, DROP signature_parent, DROP signature_enfant');
        $this->addSql('ALTER TABLE mission DROP auto_evaluation');
        $this->addSql('ALTER TABLE user DROP kins, DROP points_bonus');
    }
}
