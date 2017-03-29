<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170323200458 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post CHANGE author_id author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user CHANGE avatar avatar VARCHAR(160) DEFAULT NULL, CHANGE birthday birthday DATETIME DEFAULT NULL, CHANGE description description VARCHAR(160) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user CHANGE avatar avatar VARCHAR(160) NOT NULL COLLATE utf8_unicode_ci, CHANGE birthday birthday DATETIME NOT NULL, CHANGE description description VARCHAR(160) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE post CHANGE author_id author_id INT NOT NULL');
    }
}
