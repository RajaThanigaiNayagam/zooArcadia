<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240824180236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD race_id INT DEFAULT NULL, ADD habitat_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AAB231F6E59D40D ON animal (race_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FAFFE2D26 ON animal (habitat_id)');
        $this->addSql('ALTER TABLE image ADD habitat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FAFFE2D26 ON image (habitat_id)');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD user_id INT NOT NULL, ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD CONSTRAINT FK_CE729CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD CONSTRAINT FK_CE729CDE8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_CE729CDEA76ED395 ON rapport_veterinaire (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CE729CDE8E962C16 ON rapport_veterinaire (animal_id)');
        $this->addSql('ALTER TABLE role ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_57698A6AA76ED395 ON role (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6E59D40D');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26');
        $this->addSql('DROP INDEX UNIQ_6AAB231F6E59D40D ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231FAFFE2D26 ON animal');
        $this->addSql('ALTER TABLE animal DROP race_id, DROP habitat_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FAFFE2D26');
        $this->addSql('DROP INDEX IDX_C53D045FAFFE2D26 ON image');
        $this->addSql('ALTER TABLE image DROP habitat_id');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP FOREIGN KEY FK_CE729CDEA76ED395');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP FOREIGN KEY FK_CE729CDE8E962C16');
        $this->addSql('DROP INDEX IDX_CE729CDEA76ED395 ON rapport_veterinaire');
        $this->addSql('DROP INDEX UNIQ_CE729CDE8E962C16 ON rapport_veterinaire');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP user_id, DROP animal_id');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AA76ED395');
        $this->addSql('DROP INDEX IDX_57698A6AA76ED395 ON role');
        $this->addSql('ALTER TABLE role DROP user_id');
    }
}
