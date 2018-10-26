<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181026134926 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, src VARCHAR(255) NOT NULL, uploaded_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_user ADD avatar_id INT DEFAULT NULL, DROP avatar');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A647986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647986383B10 ON fos_user (avatar_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A647986383B10');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP INDEX UNIQ_957A647986383B10 ON fos_user');
        $this->addSql('ALTER TABLE fos_user ADD avatar VARCHAR(160) DEFAULT NULL COLLATE utf8_unicode_ci, DROP avatar_id');
    }
}
