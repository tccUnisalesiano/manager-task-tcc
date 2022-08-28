<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828144658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto ADD porcentagem INT DEFAULT NULL, ADD tempo_gasto_total DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE tarefa ADD tempo_gasto DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB88DBC4045');
        $this->addSql('DROP INDEX IDX_3C997CB88DBC4045 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto DROP id_valor_funcionario_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto DROP porcentagem, DROP tempo_gasto_total');
        $this->addSql('ALTER TABLE tarefa DROP tempo_gasto');
        $this->addSql('ALTER TABLE tempogasto ADD id_valor_funcionario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB88DBC4045 FOREIGN KEY (id_valor_funcionario_id) REFERENCES valorfuncionario (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C997CB88DBC4045 ON tempogasto (id_valor_funcionario_id)');
    }
}
