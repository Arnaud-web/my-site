<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715121400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_created_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, statu TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_23A0E66989D9B62 (slug), INDEX IDX_23A0E66F987D8A8 (user_created_id), INDEX IDX_23A0E66BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_vu (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D57EA8F07294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_vu_user (article_vu_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B27DB3E52E6DCEF (article_vu_id), INDEX IDX_B27DB3E5A76ED395 (user_id), PRIMARY KEY(article_vu_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, user_comment_id INT DEFAULT NULL, commented_at DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_67F068BC7294869C (article_id), INDEX IDX_67F068BC5F0EBBFF (user_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_FEC530A97294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_article (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_51B744457294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_article_user (like_article_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_37623A81D1002664 (like_article_id), INDEX IDX_37623A81A76ED395 (user_id), PRIMARY KEY(like_article_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_send_id INT DEFAULT NULL, user_receved_id INT DEFAULT NULL, message TINYTEXT NOT NULL, idm VARCHAR(255) NOT NULL, send_at DATETIME DEFAULT NULL, new TINYINT(1) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B6BD307F4B9E2071 (user_send_id), INDEX IDX_B6BD307F86A29159 (user_receved_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_vu (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, message_id INT DEFAULT NULL, vu_at DATETIME DEFAULT NULL, INDEX IDX_F4903D45A76ED395 (user_id), INDEX IDX_F4903D45537A1329 (message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, user_style_id INT DEFAULT NULL, nav_color VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_33BDB86A5A408474 (user_style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6495E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user (user_source INT NOT NULL, user_target INT NOT NULL, INDEX IDX_F7129A803AD8644E (user_source), INDEX IDX_F7129A80233D34C1 (user_target), PRIMARY KEY(user_source, user_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_photo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F6757F40A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F987D8A8 FOREIGN KEY (user_created_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article_vu ADD CONSTRAINT FK_D57EA8F07294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_vu_user ADD CONSTRAINT FK_B27DB3E52E6DCEF FOREIGN KEY (article_vu_id) REFERENCES article_vu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_vu_user ADD CONSTRAINT FK_B27DB3E5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5F0EBBFF FOREIGN KEY (user_comment_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A97294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE like_article ADD CONSTRAINT FK_51B744457294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE like_article_user ADD CONSTRAINT FK_37623A81D1002664 FOREIGN KEY (like_article_id) REFERENCES like_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE like_article_user ADD CONSTRAINT FK_37623A81A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4B9E2071 FOREIGN KEY (user_send_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F86A29159 FOREIGN KEY (user_receved_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message_vu ADD CONSTRAINT FK_F4903D45A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message_vu ADD CONSTRAINT FK_F4903D45537A1329 FOREIGN KEY (message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE style ADD CONSTRAINT FK_33BDB86A5A408474 FOREIGN KEY (user_style_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_photo ADD CONSTRAINT FK_F6757F40A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_vu DROP FOREIGN KEY FK_D57EA8F07294869C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A97294869C');
        $this->addSql('ALTER TABLE like_article DROP FOREIGN KEY FK_51B744457294869C');
        $this->addSql('ALTER TABLE article_vu_user DROP FOREIGN KEY FK_B27DB3E52E6DCEF');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE like_article_user DROP FOREIGN KEY FK_37623A81D1002664');
        $this->addSql('ALTER TABLE message_vu DROP FOREIGN KEY FK_F4903D45537A1329');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F987D8A8');
        $this->addSql('ALTER TABLE article_vu_user DROP FOREIGN KEY FK_B27DB3E5A76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5F0EBBFF');
        $this->addSql('ALTER TABLE like_article_user DROP FOREIGN KEY FK_37623A81A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4B9E2071');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F86A29159');
        $this->addSql('ALTER TABLE message_vu DROP FOREIGN KEY FK_F4903D45A76ED395');
        $this->addSql('ALTER TABLE style DROP FOREIGN KEY FK_33BDB86A5A408474');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A803AD8644E');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A80233D34C1');
        $this->addSql('ALTER TABLE user_photo DROP FOREIGN KEY FK_F6757F40A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_vu');
        $this->addSql('DROP TABLE article_vu_user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE like_article');
        $this->addSql('DROP TABLE like_article_user');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_vu');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('DROP TABLE user_photo');
    }
}
