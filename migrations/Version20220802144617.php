<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802144617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE funcionario ADD is_ativo TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE tarefa ADD id_funcionario_id INT NOT NULL');
        $this->addSql('ALTER TABLE tarefa ADD CONSTRAINT FK_31B4CBA59495670 FOREIGN KEY (id_funcionario_id) REFERENCES funcionario (id)');
        $this->addSql('CREATE INDEX IDX_31B4CBA59495670 ON tarefa (id_funcionario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE funcionario DROP is_ativo');
        $this->addSql('ALTER TABLE tarefa DROP FOREIGN KEY FK_31B4CBA59495670');
        $this->addSql('DROP INDEX IDX_31B4CBA59495670 ON tarefa');
        $this->addSql('ALTER TABLE tarefa DROP id_funcionario_id');
    }
}
