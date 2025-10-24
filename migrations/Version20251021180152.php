<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251021180152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

   public function up(Schema $schema): void
{
    // Ajouter ref et category si elles n'existent pas
    $this->addSql('ALTER TABLE book ADD COLUMN ref VARCHAR(50) UNIQUE NOT NULL');
    $this->addSql('ALTER TABLE book ADD COLUMN category VARCHAR(50) NOT NULL');
}
public function down(Schema $schema): void
{
    $this->addSql('ALTER TABLE book DROP COLUMN ref');
    $this->addSql('ALTER TABLE book DROP COLUMN category');
}


}
