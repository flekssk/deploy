<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116150301 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql("INSERT INTO users (uuid, roles, name, email, is_active, created_at)
VALUES (77605, 'ROLE_ADMIN', 'Осипов Алексей', 'osipov@action-mcfr.ru', TRUE, NOW())
ON CONFLICT ON CONSTRAINT users_pkey DO UPDATE SET
        roles = EXCLUDED.roles,
        is_active = EXCLUDED.is_active");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DELETE FROM project WHERE name = \'marketing/ase/cxychet\'');
        $this->addSql('DELETE FROM project WHERE name = \'marketing/ase/ugpr\'');
    }
}
