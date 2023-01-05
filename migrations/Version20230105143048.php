<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105143048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_partenaire DROP FOREIGN KEY FK_9CA9A784FB88E14F');
        $this->addSql('DROP INDEX IDX_9CA9A784FB88E14F ON fiche_partenaire');
        $this->addSql('ALTER TABLE fiche_partenaire ADD email VARCHAR(255) NOT NULL, ADD telephone VARCHAR(30) NOT NULL, DROP utilisateur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_partenaire ADD utilisateur_id INT NOT NULL, DROP email, DROP telephone');
        $this->addSql('ALTER TABLE fiche_partenaire ADD CONSTRAINT FK_9CA9A784FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_9CA9A784FB88E14F ON fiche_partenaire (utilisateur_id)');
    }
}
