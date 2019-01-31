<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131162117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sign_department (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, first_color VARCHAR(255) NOT NULL, secondary_color VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, pinterest VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_954B0055F98F144A (logo_id), UNIQUE INDEX UNIQ_954B00553DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sign_image (id INT AUTO_INCREMENT NOT NULL, updated_at DATETIME DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sign_user (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, secondary_email VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, function VARCHAR(255) NOT NULL, twitter VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, secondary_phone VARCHAR(255) DEFAULT NULL, reset_code VARCHAR(255) DEFAULT NULL, send_reset_code_at VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8AF81D20E7927C74 (email), INDEX IDX_8AF81D20AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sign_department ADD CONSTRAINT FK_954B0055F98F144A FOREIGN KEY (logo_id) REFERENCES sign_image (id)');
        $this->addSql('ALTER TABLE sign_department ADD CONSTRAINT FK_954B00553DA5256D FOREIGN KEY (image_id) REFERENCES sign_image (id)');
        $this->addSql('ALTER TABLE sign_user ADD CONSTRAINT FK_8AF81D20AE80F5DF FOREIGN KEY (department_id) REFERENCES sign_department (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sign_user DROP FOREIGN KEY FK_8AF81D20AE80F5DF');
        $this->addSql('ALTER TABLE sign_department DROP FOREIGN KEY FK_954B0055F98F144A');
        $this->addSql('ALTER TABLE sign_department DROP FOREIGN KEY FK_954B00553DA5256D');
        $this->addSql('DROP TABLE sign_department');
        $this->addSql('DROP TABLE sign_image');
        $this->addSql('DROP TABLE sign_user');
    }
}
