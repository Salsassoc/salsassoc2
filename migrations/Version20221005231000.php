<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005231000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create cotisation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE cotisation_type (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            label VARCHAR(100) NOT NULL
        )');
        $this->addSql('CREATE TABLE cotisation (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            label VARCHAR(100) NOT NULL,
            amount FLOAT NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            fiscal_year_id INTEGER NOT NULL,
            cotisation_type_id INTEGER NOT NULL,
            CONSTRAINT FK_COTISATION_FISCAL_YEAR_ID FOREIGN KEY (fiscal_year_id) REFERENCES fiscal_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
            CONSTRAINT FK_COTISATION_COTISATION_TYPE_ID FOREIGN KEY (cotisation_type_id) REFERENCES cotisation_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        )');
        $this->addSql('CREATE INDEX IDX_COTISATION_FISCAL_YEAR_ID ON cotisation (fiscal_year_id)');
        $this->addSql('CREATE INDEX IDX_COTISATION_COTISATION_TYPE_ID ON cotisation (cotisation_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cotisation');
        $this->addSql('DROP TABLE cotisation_type');
    }
}
