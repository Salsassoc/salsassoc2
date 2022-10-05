<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221004165114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE messenger_messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            body CLOB NOT NULL, headers CLOB NOT NULL,
            queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL,
            available_at DATETIME NOT NULL,
            delivered_at DATETIME DEFAULT NULL
        )');
        $this->addSql('CREATE INDEX IDX_MESSENGER_MESSAGES_QUEUE_NAME ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_MESSENGER_MESSAGES_AVAILABLE_AT ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_MESSENGER_MESSAGES_DELIVERED_AT ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE messenger_messages');
    }
}
