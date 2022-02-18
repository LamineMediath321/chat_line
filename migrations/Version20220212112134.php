<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220212112134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation de la table messages';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `messages` (id INT AUTO_INCREMENT NOT NULL, emmeteur_id INT NOT NULL, recepteur_id INT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, INDEX IDX_DB021E967220BD21 (emmeteur_id), INDEX IDX_DB021E963B49782D (recepteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `messages` ADD CONSTRAINT FK_DB021E967220BD21 FOREIGN KEY (emmeteur_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `messages` ADD CONSTRAINT FK_DB021E963B49782D FOREIGN KEY (recepteur_id) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `messages`');
    }
}
