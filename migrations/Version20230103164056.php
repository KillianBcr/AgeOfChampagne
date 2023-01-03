<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103164056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, DROP image_carte');
        $this->addSql('ALTER TABLE fiche_partenaire DROP FOREIGN KEY FK_9CA9A784FB88E14F');
        $this->addSql('DROP INDEX IDX_9CA9A784FB88E14F ON fiche_partenaire');
        $this->addSql('ALTER TABLE fiche_partenaire DROP utilisateur_id, DROP is_public');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte ADD image_carte VARCHAR(255) NOT NULL, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE fiche_partenaire ADD utilisateur_id INT NOT NULL, ADD is_public TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE fiche_partenaire ADD CONSTRAINT FK_9CA9A784FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_9CA9A784FB88E14F ON fiche_partenaire (utilisateur_id)');
    }
}
