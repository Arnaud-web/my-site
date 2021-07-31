<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730150159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_reponse (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, created_at DATETIME NOT NULL, reponse LONGTEXT DEFAULT NULL, date_entretien DATETIME DEFAULT NULL, statu VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_625E69F44B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_reponse ADD CONSTRAINT FK_625E69F44B89032C FOREIGN KEY (post_id) REFERENCES post_emploi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post_reponse');
    }
}
