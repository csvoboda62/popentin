<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201173616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pop ADD serie_id INT NOT NULL');
        $this->addSql('ALTER TABLE pop ADD CONSTRAINT FK_19D0B716D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_19D0B716D94388BD ON pop (serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pop DROP FOREIGN KEY FK_19D0B716D94388BD');
        $this->addSql('DROP INDEX IDX_19D0B716D94388BD ON pop');
        $this->addSql('ALTER TABLE pop DROP serie_id');
    }
}
