<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251024200119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON book');
        $this->addSql('ALTER TABLE book ADD ref VARCHAR(50) NOT NULL, ADD category VARCHAR(50) NOT NULL, DROP id, CHANGE title title VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE book ADD PRIMARY KEY (ref)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD id INT AUTO_INCREMENT NOT NULL, DROP ref, DROP category, CHANGE title title VARCHAR(50) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
