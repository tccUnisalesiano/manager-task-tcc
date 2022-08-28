<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828203915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB859495670');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB859495670 FOREIGN KEY (id_funcionario_id) REFERENCES funcionario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB859495670');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB859495670 FOREIGN KEY (id_funcionario_id) REFERENCES tarefa (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
