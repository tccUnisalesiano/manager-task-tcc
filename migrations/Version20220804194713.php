<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220804194713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto DROP FOREIGN KEY FK_A0559D944B6E0ED1');
        $this->addSql('DROP INDEX IDX_A0559D944B6E0ED1 ON projeto');
        $this->addSql('ALTER TABLE projeto CHANGE cpf_cnpj_id cliente_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projeto ADD CONSTRAINT FK_A0559D94ACC9C364 FOREIGN KEY (cliente_id_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_A0559D94ACC9C364 ON projeto (cliente_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto DROP FOREIGN KEY FK_A0559D94ACC9C364');
        $this->addSql('DROP INDEX IDX_A0559D94ACC9C364 ON projeto');
        $this->addSql('ALTER TABLE projeto CHANGE cliente_id_id cpf_cnpj_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projeto ADD CONSTRAINT FK_A0559D944B6E0ED1 FOREIGN KEY (cpf_cnpj_id) REFERENCES cliente (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A0559D944B6E0ED1 ON projeto (cpf_cnpj_id)');
    }
}
