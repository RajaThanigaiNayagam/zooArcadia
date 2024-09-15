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
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(50) NOT NULL, etat VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, commentaire VARCHAR(250) DEFAULT NULL, is_visible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(250) DEFAULT NULL, commentaire_habitat VARCHAR(250) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image_data LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_image (id INT AUTO_INCREMENT NOT NULL, image_data LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_employee (id INT AUTO_INCREMENT NOT NULL, nourriture VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', quantité INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_veterinaire (id INT AUTO_INCREMENT NOT NULL, detail VARCHAR(250) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(250) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON user (username)');

        
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal_image CHANGE image_data image_data VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE avis CHANGE commentaire commentaire VARCHAR(255) DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE habitat DROP description, CHANGE commentaire_habitat commentaire_habitat LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE image_data image_data VARCHAR(250) NOT NULL');
        $this->addSql('ALTER TABLE race CHANGE label label VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE rapport_employee CHANGE quantité quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD status VARCHAR(250) NOT NULL, ADD food VARCHAR(50) DEFAULT NULL, ADD foodgrammage BIGINT DEFAULT NULL, CHANGE detail detail VARCHAR(250) NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE label label VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE description description VARCHAR(50) DEFAULT NULL');

        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_USERNAME ON user');
        $this->addSql('ALTER TABLE user ADD role_id INT DEFAULT NULL, CHANGE username username VARCHAR(18) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');

        
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal_image ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal_image ADD CONSTRAINT FK_E4CEDDAB8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_E4CEDDAB8E962C16 ON animal_image (animal_id)');

        $this->addSql('ALTER TABLE image ADD habitat_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FAFFE2D26 ON image (habitat_id)');

        $this->addSql('ALTER TABLE rapport_employee ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE rapport_employee ADD CONSTRAINT FK_895F9523A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_895F9523A76ED395 ON rapport_employee (user_id)');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD CONSTRAINT FK_CE729CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CE729CDEA76ED395 ON rapport_veterinaire (user_id)');
        
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD habitat_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FAFFE2D26 ON animal (habitat_id)');

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD race_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('CREATE INDEX UNIQ_6AAB231F6E59D40D ON animal (race_id)');

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_employee ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE rapport_employee ADD CONSTRAINT FK_895F95238E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_895F95238E962C16 ON rapport_employee (animal_id)');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire ADD CONSTRAINT FK_CE729CDE8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_CE729CDE8E962C16 ON rapport_veterinaire (animal_id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE habitat');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE animal_image');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE rapport_employee');
        $this->addSql('DROP TABLE rapport_veterinaire');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE `user`');

        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE animal_image CHANGE image_data image_data LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE avis CHANGE commentaire commentaire VARCHAR(250) DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE habitat ADD description VARCHAR(250) DEFAULT NULL, CHANGE commentaire_habitat commentaire_habitat VARCHAR(250) DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE image_data image_data LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE race CHANGE label label VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_employee CHANGE quantity quantité INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP status, DROP food, DROP foodgrammage, CHANGE detail detail VARCHAR(250) DEFAULT NULL');
        $this->addSql('ALTER TABLE role CHANGE label label VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE description description VARCHAR(250) DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC ON user');
        $this->addSql('ALTER TABLE user DROP role_id, CHANGE username username VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON user (username)');

        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal_image DROP FOREIGN KEY FK_E4CEDDAB8E962C16');
        $this->addSql('DROP INDEX IDX_E4CEDDAB8E962C16 ON animal_image');
        $this->addSql('ALTER TABLE animal_image DROP animal_id');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FAFFE2D26');
        $this->addSql('DROP INDEX IDX_C53D045FAFFE2D26 ON image');
        $this->addSql('ALTER TABLE image DROP habitat_id');

        $this->addSql('ALTER TABLE rapport_employee DROP FOREIGN KEY FK_895F9523A76ED395');
        $this->addSql('DROP INDEX IDX_895F9523A76ED395 ON rapport_employee');
        $this->addSql('ALTER TABLE rapport_employee DROP user_id');

        $this->addSql('ALTER TABLE rapport_veterinaire DROP FOREIGN KEY FK_CE729CDEA76ED395');
        $this->addSql('DROP INDEX IDX_CE729CDEA76ED395 ON rapport_veterinaire');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP user_id');

        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26');
        $this->addSql('DROP INDEX IDX_6AAB231FAFFE2D26 ON animal');
        $this->addSql('ALTER TABLE animal DROP habitat_id');
        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6E59D40D');
        $this->addSql('DROP INDEX IDX_6AAB231F6E59D40D ON animal');
        $this->addSql('ALTER TABLE animal DROP race_id');
        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_employee DROP FOREIGN KEY FK_895F95238E962C16');
        $this->addSql('DROP INDEX IDX_895F95238E962C16 ON rapport_employee');
        $this->addSql('ALTER TABLE rapport_employee DROP animal_id');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP FOREIGN KEY FK_CE729CDE8E962C16');
        $this->addSql('DROP INDEX IDX_CE729CDE8E962C16 ON rapport_veterinaire');
        $this->addSql('ALTER TABLE rapport_veterinaire DROP animal_id');
    }
}
