<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240930185348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD email VARCHAR(50) DEFAULT NULL');
        //$this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        //$this->addSql('DROP INDEX fk_8d93d649d60322ac ON user');
        //$this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
        //$this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP email');
        //$this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        //$this->addSql('DROP INDEX idx_8d93d649d60322ac ON user');
        //$this->addSql('CREATE INDEX FK_8D93D649D60322AC ON user (role_id)');
        //$this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }
}
