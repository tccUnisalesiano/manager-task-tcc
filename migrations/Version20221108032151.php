<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108032151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nome_cliente VARCHAR(100) DEFAULT NULL, tipo_cliente VARCHAR(100) DEFAULT NULL, email_cliente VARCHAR(100) DEFAULT NULL, celular_cliente INT DEFAULT NULL, cpf_cnpj VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projeto (id INT AUTO_INCREMENT NOT NULL, cliente_id_id INT DEFAULT NULL, nome VARCHAR(100) DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, situacao VARCHAR(255) DEFAULT NULL, data_ini_previsto DATETIME DEFAULT NULL, data_fim_previsto DATETIME DEFAULT NULL, data_entrega_final DATETIME DEFAULT NULL, data_inicial DATETIME DEFAULT NULL, porcentagem INT DEFAULT NULL, tempo_gasto_total DOUBLE PRECISION DEFAULT NULL, INDEX IDX_A0559D94ACC9C364 (cliente_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarefa (id INT AUTO_INCREMENT NOT NULL, id_projeto_id INT DEFAULT NULL, id_user_id INT NOT NULL, prioridade VARCHAR(100) DEFAULT NULL, situacao VARCHAR(100) DEFAULT NULL, status VARCHAR(100) DEFAULT NULL, nome VARCHAR(100) DEFAULT NULL, descricao VARCHAR(100) DEFAULT NULL, tempo_estimado DOUBLE PRECISION DEFAULT NULL, data_ini DATE DEFAULT NULL, data_fim DATE DEFAULT NULL, documentacao LONGTEXT DEFAULT NULL, tipo_tarefa VARCHAR(100) DEFAULT NULL, porcentagem INT DEFAULT NULL, tempo_gasto DOUBLE PRECISION DEFAULT NULL, INDEX IDX_31B4CBAE63F0447 (id_projeto_id), INDEX IDX_31B4CBA79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tempogasto (id INT AUTO_INCREMENT NOT NULL, id_tarefa_id INT DEFAULT NULL, id_user_id INT DEFAULT NULL, atividade VARCHAR(100) DEFAULT NULL, data DATE DEFAULT NULL, tempo DOUBLE PRECISION DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, INDEX IDX_3C997CB8F814CB37 (id_tarefa_id), INDEX IDX_3C997CB879F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, is_ativo TINYINT(1) NOT NULL, nome VARCHAR(255) NOT NULL, carga_horaria_semanal DOUBLE PRECISION NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valorfuncionario (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, valor_hora DOUBLE PRECISION DEFAULT NULL, data_ini DATE DEFAULT NULL, data_fim DATE DEFAULT NULL, INDEX IDX_C2C4138479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projeto ADD CONSTRAINT FK_A0559D94ACC9C364 FOREIGN KEY (cliente_id_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tarefa ADD CONSTRAINT FK_31B4CBAE63F0447 FOREIGN KEY (id_projeto_id) REFERENCES projeto (id)');
        $this->addSql('ALTER TABLE tarefa ADD CONSTRAINT FK_31B4CBA79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB8F814CB37 FOREIGN KEY (id_tarefa_id) REFERENCES tarefa (id)');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE valorfuncionario ADD CONSTRAINT FK_C2C4138479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto DROP FOREIGN KEY FK_A0559D94ACC9C364');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE tarefa DROP FOREIGN KEY FK_31B4CBAE63F0447');
        $this->addSql('ALTER TABLE tarefa DROP FOREIGN KEY FK_31B4CBA79F37AE5');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB8F814CB37');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB879F37AE5');
        $this->addSql('ALTER TABLE valorfuncionario DROP FOREIGN KEY FK_C2C4138479F37AE5');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE projeto');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE tarefa');
        $this->addSql('DROP TABLE tempogasto');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE valorfuncionario');
    }
}
