<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114092925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(100) NOT NULL, adress VARCHAR(50) NOT NULL, postcode VARCHAR(10) NOT NULL, woonplaats VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recept (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, medicijn VARCHAR(100) NOT NULL, datum VARCHAR(255) NOT NULL, periode VARCHAR(255) NOT NULL, INDEX IDX_B92268A16B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recept ADD CONSTRAINT FK_B92268A16B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recept DROP FOREIGN KEY FK_B92268A16B899279');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE recept');
    }
}
