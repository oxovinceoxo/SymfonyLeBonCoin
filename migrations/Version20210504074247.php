<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504074247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168FB88E14F');
        $this->addSql('DROP INDEX IDX_BFDD3168FB88E14F ON articles');
        $this->addSql('ALTER TABLE articles DROP utilisateur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168FB88E14F ON articles (utilisateur_id)');
    }
}
