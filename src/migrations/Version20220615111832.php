<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615111832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction ADD created_user VARCHAR(255) DEFAULT NULL, ADD updated_user VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE form ADD created_user VARCHAR(255) DEFAULT NULL, ADD updated_user VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD created_user VARCHAR(255) DEFAULT NULL, ADD updated_user VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD created_user VARCHAR(255) DEFAULT NULL, ADD updated_user VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction DROP created_user, DROP updated_user');
        $this->addSql('ALTER TABLE form DROP created_user, DROP updated_user');
        $this->addSql('ALTER TABLE hotel DROP created_user, DROP updated_user');
        $this->addSql('ALTER TABLE room DROP created_user, DROP updated_user');
    }
}
