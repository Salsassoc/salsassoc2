<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004165114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cotisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fiscal_year_id INTEGER NOT NULL, cotisation_type_id INTEGER NOT NULL, label VARCHAR(100) NOT NULL, amount DOUBLE PRECISION NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_AE64D2ED63F9139E FOREIGN KEY (fiscal_year_id) REFERENCES fiscal_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AE64D2EDC9FF2389 FOREIGN KEY (cotisation_type_id) REFERENCES cotisation_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AE64D2ED63F9139E ON cotisation (fiscal_year_id)');
        $this->addSql('CREATE INDEX IDX_AE64D2EDC9FF2389 ON cotisation (cotisation_type_id)');
        $this->addSql('CREATE TABLE cotisation_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE fiscal_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, is_current BOOLEAN NOT NULL, title VARCHAR(50) DEFAULT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cotisation');
        $this->addSql('DROP TABLE cotisation_type');
        $this->addSql('DROP TABLE fiscal_year');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
