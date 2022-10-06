<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006131358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE membership_type (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            label VARCHAR(50) NOT NULL
        )');

        $this->addSql('CREATE TABLE membership (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            member_id INTEGER NOT NULL,
            membership_type_id INTEGER NOT NULL,
            fiscal_year_id INTEGER NOT NULL,
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
            allow_image_rights BOOLEAN DEFAULT NULL,
            membership_date DATE NOT NULL,
            comments TEXT DEFAULT NULL,
            CONSTRAINT FK_MEMBERSHIP_MEMBER_ID FOREIGN KEY (member_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
            CONSTRAINT FK_MEMBERSHIP_MEMBERSHIP_TYPE_ID FOREIGN KEY (membership_type_id) REFERENCES membership_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
            CONSTRAINT FK_MEMBERSHIP_FISCAL_YEAR_ID FOREIGN KEY (fiscal_year_id) REFERENCES fiscal_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        )');
        $this->addSql('CREATE INDEX IDX_MEMBERSHIP_MEMBER_ID ON membership (member_id)');
        $this->addSql('CREATE INDEX IDX_MEMBERSHIP_MEMBERSHIP_TYPE_ID ON membership (membership_type_id)');
        $this->addSql('CREATE INDEX IDX_MEMBERSHIP_FISCAL_YEAR_ID ON membership (fiscal_year_id)');

        $this->addSql('CREATE TABLE membership_cotisation (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            membership_id INTEGER NOT NULL, cotisation_id INTEGER NOT NULL,
            payment_method_id INTEGER DEFAULT NULL,
            date DATE NOT NULL,
            amount DOUBLE PRECISION NOT NULL,
            CONSTRAINT FK_MEMBERSHIP_COTISATION_MEMBERSHIP_ID FOREIGN KEY (membership_id) REFERENCES membership (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
            CONSTRAINT FK_MEMBERSHIP_COTISATION_ID FOREIGN KEY (cotisation_id) REFERENCES cotisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE,
            CONSTRAINT FK_MEMBERSHIP_COTISATION_PAYMENT_METHOD_ID FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        )');
        $this->addSql('CREATE INDEX IDX_MEMBERSHIP_COTISATION_MEMBERSHIP_ID ON membership_cotisation (membership_id)');
        $this->addSql('CREATE INDEX IDX_MEMBERSHIP_COTISATION_ID ON membership_cotisation (cotisation_id)');
        $this->addSql('CREATE INDEX IDX_MEMBERSHIP_COTISATION_PAYMENT_METHOD_ID ON membership_cotisation (payment_method_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE membership_cotisation');
        $this->addSql('DROP TABLE membership');
        $this->addSql('DROP TABLE membership_type');
    }
}
