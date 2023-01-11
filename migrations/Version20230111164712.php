<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111164712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte ADD crus_id INT NOT NULL, ADD cepage_id INT NOT NULL');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFDB0605923 FOREIGN KEY (crus_id) REFERENCES crus (id)');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFD8AC6BB8A FOREIGN KEY (cepage_id) REFERENCES cepage (id)');
        $this->addSql('CREATE INDEX IDX_BAD4FFFDB0605923 ON carte (crus_id)');
        $this->addSql('CREATE INDEX IDX_BAD4FFFD8AC6BB8A ON carte (cepage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFDB0605923');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFD8AC6BB8A');
        $this->addSql('DROP INDEX IDX_BAD4FFFDB0605923 ON carte');
        $this->addSql('DROP INDEX IDX_BAD4FFFD8AC6BB8A ON carte');
        $this->addSql('ALTER TABLE carte DROP crus_id, DROP cepage_id');
    }
}
