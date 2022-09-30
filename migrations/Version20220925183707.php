<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220925183707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sprint');
        $this->addSql('DROP TABLE situacao');
        $this->addSql('DROP TABLE prioridade');
        $this->addSql('ALTER TABLE projeto ADD cliente_id_id INT DEFAULT NULL, ADD situacao VARCHAR(255) DEFAULT NULL, ADD data_ini_previsto DATETIME DEFAULT NULL, ADD data_fim_previsto DATETIME DEFAULT NULL, ADD data_entrega_final DATETIME DEFAULT NULL, ADD data_inicial DATETIME DEFAULT NULL, ADD porcentagem INT DEFAULT NULL, ADD tempo_gasto_total DOUBLE PRECISION DEFAULT NULL, CHANGE nome_projeto nome VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE projeto ADD CONSTRAINT FK_A0559D94ACC9C364 FOREIGN KEY (cliente_id_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_A0559D94ACC9C364 ON projeto (cliente_id_id)');
        $this->addSql('ALTER TABLE tarefa ADD porcentagem INT DEFAULT NULL, ADD tempo_gasto DOUBLE PRECISION DEFAULT NULL, CHANGE nome_tarefa status VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB88DBC4045');
        $this->addSql('DROP INDEX IDX_3C997CB88DBC4045 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto CHANGE id_valor_funcionario_id id_funcionario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB859495670 FOREIGN KEY (id_funcionario_id) REFERENCES funcionario (id)');
        $this->addSql('CREATE INDEX IDX_3C997CB859495670 ON tempogasto (id_funcionario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sprint (id INT AUTO_INCREMENT NOT NULL, situacao VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, descricao VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, versao VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, duracao VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, data_ini DATETIME DEFAULT NULL, data_fim DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE situacao (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prioridade (id INT AUTO_INCREMENT NOT NULL, nome_prioridade VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, cor VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB859495670');
        $this->addSql('DROP INDEX IDX_3C997CB859495670 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto CHANGE id_funcionario_id id_valor_funcionario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB88DBC4045 FOREIGN KEY (id_valor_funcionario_id) REFERENCES valorfuncionario (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C997CB88DBC4045 ON tempogasto (id_valor_funcionario_id)');
        $this->addSql('ALTER TABLE tarefa DROP porcentagem, DROP tempo_gasto, CHANGE status nome_tarefa VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE projeto DROP FOREIGN KEY FK_A0559D94ACC9C364');
        $this->addSql('DROP INDEX IDX_A0559D94ACC9C364 ON projeto');
        $this->addSql('ALTER TABLE projeto DROP cliente_id_id, DROP situacao, DROP data_ini_previsto, DROP data_fim_previsto, DROP data_entrega_final, DROP data_inicial, DROP porcentagem, DROP tempo_gasto_total, CHANGE nome nome_projeto VARCHAR(100) DEFAULT NULL');
    }
}
