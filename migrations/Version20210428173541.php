<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428173541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316898260155 FOREIGN KEY (region_id) REFERENCES regions (id)');
        $this->addSql('CREATE INDEX IDX_BFDD316898260155 ON articles (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316898260155');
        $this->addSql('DROP INDEX IDX_BFDD316898260155 ON articles');
        $this->addSql('ALTER TABLE articles DROP region_id');
    }
}
