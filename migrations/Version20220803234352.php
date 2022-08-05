<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803234352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto ADD cpf_cnpj_id INT DEFAULT NULL, DROP cpf_cnpj');
        $this->addSql('ALTER TABLE projeto ADD CONSTRAINT FK_A0559D944B6E0ED1 FOREIGN KEY (cpf_cnpj_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_A0559D944B6E0ED1 ON projeto (cpf_cnpj_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projeto DROP FOREIGN KEY FK_A0559D944B6E0ED1');
        $this->addSql('DROP INDEX IDX_A0559D944B6E0ED1 ON projeto');
        $this->addSql('ALTER TABLE projeto ADD cpf_cnpj VARCHAR(100) DEFAULT NULL, DROP cpf_cnpj_id');
    }
}
