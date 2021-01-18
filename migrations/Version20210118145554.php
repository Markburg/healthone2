<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118145554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicijn ADD recept_id INT NOT NULL');
        $this->addSql('ALTER TABLE medicijn ADD CONSTRAINT FK_AB883601C6BF5295 FOREIGN KEY (recept_id) REFERENCES recept (id)');
        $this->addSql('CREATE INDEX IDX_AB883601C6BF5295 ON medicijn (recept_id)');
        $this->addSql('ALTER TABLE recept DROP FOREIGN KEY FK_B92268A1DFC35CB');
        $this->addSql('DROP INDEX IDX_B92268A1DFC35CB ON recept');
        $this->addSql('ALTER TABLE recept DROP medicijn_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicijn DROP FOREIGN KEY FK_AB883601C6BF5295');
        $this->addSql('DROP INDEX IDX_AB883601C6BF5295 ON medicijn');
        $this->addSql('ALTER TABLE medicijn DROP recept_id');
        $this->addSql('ALTER TABLE recept ADD medicijn_id INT NOT NULL');
        $this->addSql('ALTER TABLE recept ADD CONSTRAINT FK_B92268A1DFC35CB FOREIGN KEY (medicijn_id) REFERENCES medicijn (id)');
        $this->addSql('CREATE INDEX IDX_B92268A1DFC35CB ON recept (medicijn_id)');
    }
}
