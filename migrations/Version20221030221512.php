<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221030221512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarefa ADD CONSTRAINT FK_31B4CBA79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_31B4CBA79F37AE5 ON tarefa (id_user_id)');
        $this->addSql('DROP INDEX IDX_3C997CB859495670 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto CHANGE id_funcionario_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3C997CB879F37AE5 ON tempogasto (id_user_id)');
        $this->addSql('DROP INDEX IDX_C2C4138459495670 ON valorfuncionario');
        $this->addSql('ALTER TABLE valorfuncionario CHANGE id_funcionario_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE valorfuncionario ADD CONSTRAINT FK_C2C4138479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C2C4138479F37AE5 ON valorfuncionario (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE valorfuncionario DROP FOREIGN KEY FK_C2C4138479F37AE5');
        $this->addSql('DROP INDEX IDX_C2C4138479F37AE5 ON valorfuncionario');
        $this->addSql('ALTER TABLE valorfuncionario CHANGE id_user_id id_funcionario_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_C2C4138459495670 ON valorfuncionario (id_funcionario_id)');
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB879F37AE5');
        $this->addSql('DROP INDEX IDX_3C997CB879F37AE5 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto CHANGE id_user_id id_funcionario_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_3C997CB859495670 ON tempogasto (id_funcionario_id)');
        $this->addSql('ALTER TABLE tarefa DROP FOREIGN KEY FK_31B4CBA79F37AE5');
        $this->addSql('DROP INDEX IDX_31B4CBA79F37AE5 ON tarefa');
    }
}
