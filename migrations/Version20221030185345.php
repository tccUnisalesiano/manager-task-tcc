<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221030185345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB8DA670BC2');
        $this->addSql('DROP INDEX IDX_3C997CB8DA670BC2 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto CHANGE iid_user_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3C997CB879F37AE5 ON tempogasto (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tempogasto DROP FOREIGN KEY FK_3C997CB879F37AE5');
        $this->addSql('DROP INDEX IDX_3C997CB879F37AE5 ON tempogasto');
        $this->addSql('ALTER TABLE tempogasto CHANGE id_user_id iid_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tempogasto ADD CONSTRAINT FK_3C997CB8DA670BC2 FOREIGN KEY (iid_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C997CB8DA670BC2 ON tempogasto (iid_user_id)');
    }
}
