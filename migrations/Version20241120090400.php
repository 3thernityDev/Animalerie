<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120090400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animalerie ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animalerie ADD CONSTRAINT FK_21CB733E4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21CB733E4DE7DC5C ON animalerie (adresse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animalerie DROP FOREIGN KEY FK_21CB733E4DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_21CB733E4DE7DC5C ON animalerie');
        $this->addSql('ALTER TABLE animalerie DROP adresse_id');
    }
}
