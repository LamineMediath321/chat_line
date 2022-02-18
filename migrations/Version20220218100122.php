<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218100122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation des tables users and messages';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `messages` (id INT AUTO_INCREMENT NOT NULL, emmeteur_id INT NOT NULL, recepteur_id INT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DB021E967220BD21 (emmeteur_id), INDEX IDX_DB021E963B49782D (recepteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `messages` ADD CONSTRAINT FK_DB021E967220BD21 FOREIGN KEY (emmeteur_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `messages` ADD CONSTRAINT FK_DB021E963B49782D FOREIGN KEY (recepteur_id) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `messages` DROP FOREIGN KEY FK_DB021E967220BD21');
        $this->addSql('ALTER TABLE `messages` DROP FOREIGN KEY FK_DB021E963B49782D');
        $this->addSql('DROP TABLE `messages`');
        $this->addSql('DROP TABLE `users`');
    }
}
