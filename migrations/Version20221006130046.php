<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221006130046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create payment method table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE payment_method (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            label VARCHAR(50) NOT NULL
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE payment_method');
    }
}
