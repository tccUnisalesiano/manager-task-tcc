<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729234917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrador (id INT AUTO_INCREMENT NOT NULL, razao_social VARCHAR(100) DEFAULT NULL, senha VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atividade (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projeto (id INT AUTO_INCREMENT NOT NULL, nome_projeto VARCHAR(100) DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprint (id INT AUTO_INCREMENT NOT NULL, situacao VARCHAR(255) DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, versao VARCHAR(100) DEFAULT NULL, duracao VARCHAR(255) DEFAULT NULL, data_ini DATETIME DEFAULT NULL, data_fim DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarefa (id INT AUTO_INCREMENT NOT NULL, id_projeto_id INT DEFAULT NULL, prioridade VARCHAR(100) DEFAULT NULL, situacao VARCHAR(100) DEFAULT NULL, nome_tarefa VARCHAR(100) DEFAULT NULL, nome VARCHAR(100) DEFAULT NULL, descricao VARCHAR(100) DEFAULT NULL, tempo_estimado DOUBLE PRECISION DEFAULT NULL, data_ini DATE DEFAULT NULL, data_fim DATE DEFAULT NULL, documentacao LONGTEXT DEFAULT NULL, tipo_tarefa VARCHAR(100) DEFAULT NULL, INDEX IDX_31B4CBAE63F0447 (id_projeto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tempogasto (id INT AUTO_INCREMENT NOT NULL, id_tarefa_id INT DEFAULT NULL, id_valor_funcionario_id INT DEFAULT NULL, atividade VARCHAR(100) DEFAULT NULL, data DATE DEFAULT NULL, tempo DOUBLE PRECISION DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, INDEX IDX_3C997CB8F814CB37 (id_tarefa_id), INDEX IDX_3C997CB88DBC4045 (id_valor_funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valorfuncionario (id INT AUTO_INCREMENT NOT NULL, id_funcionario_id INT DEFAULT NULL, valor_hora DOUBLE PRECISION DEFAULT NULL, data_ini DATE DEFAULT NULL, data_fim DATE DEFAULT NULL, INDEX IDX_C2C4138459495670 (id_funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarefa ADD CONSTRAINT FK_31B4CBAE63F0447 FOREIGN KEY (id_projeto_id) REFERENCES projeto (id)');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB8F814CB37 FOREIGN KEY (id_tarefa_id) REFERENCES tarefa (id)');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB88DBC4045 FOREIGN KEY (id_valor_funcionario_id) REFERENCES valorfuncionario (id)');
        $this->addSql('ALTER TABLE valorfuncionario ADD CONSTRAINT FK_C2C4138459495670 FOREIGN KEY (id_funcionario_id) REFERENCES funcionario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarefa DROP FOREIGN KEY FK_31B4CBAE63F0447');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB8F814CB37');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB88DBC4045');
        $this->addSql('DROP TABLE administrador');
        $this->addSql('DROP TABLE atividade');
        $this->addSql('DROP TABLE projeto');
        $this->addSql('DROP TABLE sprint');
        $this->addSql('DROP TABLE tarefa');
        $this->addSql('DROP TABLE tempogasto');
        $this->addSql('DROP TABLE valorfuncionario');
    }
}
