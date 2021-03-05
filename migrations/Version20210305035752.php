<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305035752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account_user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, prenom VARCHAR(30) NOT NULL, email VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account_user_role_user (account_user_id INT NOT NULL, role_user_id INT NOT NULL, INDEX IDX_613BED336E45C7DD (account_user_id), INDEX IDX_613BED331BA3766E (role_user_id), PRIMARY KEY(account_user_id, role_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (id INT AUTO_INCREMENT NOT NULL, role_u VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account_user_role_user ADD CONSTRAINT FK_613BED336E45C7DD FOREIGN KEY (account_user_id) REFERENCES account_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE account_user_role_user ADD CONSTRAINT FK_613BED331BA3766E FOREIGN KEY (role_user_id) REFERENCES role_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_user_role_user DROP FOREIGN KEY FK_613BED336E45C7DD');
        $this->addSql('ALTER TABLE account_user_role_user DROP FOREIGN KEY FK_613BED331BA3766E');
        $this->addSql('DROP TABLE account_user');
        $this->addSql('DROP TABLE account_user_role_user');
        $this->addSql('DROP TABLE role_user');
    }
}
