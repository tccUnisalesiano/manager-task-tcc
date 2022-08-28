<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828201949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tempogasto ADD id_funcionario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB859495670 FOREIGN KEY (id_funcionario_id) REFERENCES tarefa (id)');
        $this->addSql('CREATE INDEX IDX_3C997CB859495670 ON tempogasto (id_funcionario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB859495670');
        $this->addSql('DROP INDEX IDX_3C997CB859495670 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto DROP id_funcionario_id');
    }
}
