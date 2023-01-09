<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109111456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3F294C38');
        $this->addSql('DROP INDEX UNIQ_9474526C3F294C38 ON comment');
        $this->addSql('ALTER TABLE comment ADD sender VARCHAR(30) NOT NULL, DROP name_uti_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD name_uti_id INT NOT NULL, DROP sender');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3F294C38 FOREIGN KEY (name_uti_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9474526C3F294C38 ON comment (name_uti_id)');
    }
}
