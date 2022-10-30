<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221029165117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE funcionario ADD imagem_perfil LONGBLOB DEFAULT NULL, DROP updated_at, DROP image_name');
        $this->addSql('ALTER TABLE user ADD is_ativo TINYINT(1) NOT NULL, ADD nome VARCHAR(255) NOT NULL, ADD carga_horaria_semanal DOUBLE PRECISION NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP is_ativo, DROP nome, DROP carga_horaria_semanal, DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE funcionario ADD updated_at DATETIME NOT NULL, ADD image_name VARCHAR(255) NOT NULL, DROP imagem_perfil');
    }
}
