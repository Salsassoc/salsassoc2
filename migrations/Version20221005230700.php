<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221005230700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create fiscal_year table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE fiscal_year (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            title VARCHAR(50) NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            is_current BOOLEAN NOT NULL DEFAULT FALSE
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE fiscal_year');
    }
}
