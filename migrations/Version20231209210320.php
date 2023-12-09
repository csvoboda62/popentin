<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231209210320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pop_image (id INT AUTO_INCREMENT NOT NULL, pop_id INT NOT NULL, name VARCHAR(255) NOT NULL, size INT NOT NULL, update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DCEFC2753BDF040 (pop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pop_image ADD CONSTRAINT FK_DCEFC2753BDF040 FOREIGN KEY (pop_id) REFERENCES pop (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pop_image DROP FOREIGN KEY FK_DCEFC2753BDF040');
        $this->addSql('DROP TABLE pop_image');
    }
}
