<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221006113924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create members table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE member (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            firstname VARCHAR(100) NOT NULL,
            gender INTEGER NOT NULL,
            birthdate DATE DEFAULT NULL,
            address VARCHAR(255) DEFAULT NULL,
            zipcode INTEGER DEFAULT NULL,
            city VARCHAR(50) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL,
            phonenumber VARCHAR(50) DEFAULT NULL,
            phonenumber2 VARCHAR(50) DEFAULT NULL,
            is_member BOOLEAN NOT NULL,
            allow_image_rights BOOLEAN DEFAULT NULL,
            comments TEXT DEFAULT NULL,
            created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE member');
    }
}
