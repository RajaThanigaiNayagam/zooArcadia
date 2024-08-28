<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828090040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal_image (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, image_data LONGBLOB NOT NULL, INDEX IDX_E4CEDDAB8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal_image ADD CONSTRAINT FK_E4CEDDAB8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE avis CHANGE commentaire commentaire VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD status VARCHAR(255) DEFAULT NULL, ADD food VARCHAR(50) NOT NULL, ADD foodgrammage DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal_image DROP FOREIGN KEY FK_E4CEDDAB8E962C16');
        $this->addSql('DROP TABLE animal_image');
        $this->addSql('ALTER TABLE avis CHANGE commentaire commentaire VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP status, DROP food, DROP foodgrammage');
    }
}
