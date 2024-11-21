<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121083355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animalerie_product (animalerie_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_6D4B86EA40103C86 (animalerie_id), INDEX IDX_6D4B86EA4584665A (product_id), PRIMARY KEY(animalerie_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animalerie_product ADD CONSTRAINT FK_6D4B86EA40103C86 FOREIGN KEY (animalerie_id) REFERENCES animalerie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animalerie_product ADD CONSTRAINT FK_6D4B86EA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal ADD animalerie_id INT DEFAULT NULL, CHANGE birthday birthday DATETIME NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F40103C86 FOREIGN KEY (animalerie_id) REFERENCES animalerie (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F40103C86 ON animal (animalerie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animalerie_product DROP FOREIGN KEY FK_6D4B86EA40103C86');
        $this->addSql('ALTER TABLE animalerie_product DROP FOREIGN KEY FK_6D4B86EA4584665A');
        $this->addSql('DROP TABLE animalerie_product');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F40103C86');
        $this->addSql('DROP INDEX IDX_6AAB231F40103C86 ON animal');
        $this->addSql('ALTER TABLE animal DROP animalerie_id, CHANGE birthday birthday DOUBLE PRECISION NOT NULL');
    }
}
