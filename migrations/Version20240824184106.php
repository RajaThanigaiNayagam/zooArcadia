<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240824184106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_employee ADD user_id INT NOT NULL, ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE rapport_employee ADD CONSTRAINT FK_895F9523A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rapport_employee ADD CONSTRAINT FK_895F95238E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_895F9523A76ED395 ON rapport_employee (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_895F95238E962C16 ON rapport_employee (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_employee DROP FOREIGN KEY FK_895F9523A76ED395');
        $this->addSql('ALTER TABLE rapport_employee DROP FOREIGN KEY FK_895F95238E962C16');
        $this->addSql('DROP INDEX IDX_895F9523A76ED395 ON rapport_employee');
        $this->addSql('DROP INDEX UNIQ_895F95238E962C16 ON rapport_employee');
        $this->addSql('ALTER TABLE rapport_employee DROP user_id, DROP animal_id');
    }
}
