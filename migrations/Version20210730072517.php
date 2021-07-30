<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730072517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_emploi (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, user_post_id INT DEFAULT NULL, lettre LONGTEXT NOT NULL, post_at DATETIME NOT NULL, INDEX IDX_4482549F7294869C (article_id), INDEX IDX_4482549F13841D26 (user_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_emploi ADD CONSTRAINT FK_4482549F7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE post_emploi ADD CONSTRAINT FK_4482549F13841D26 FOREIGN KEY (user_post_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post_emploi');
    }
}
