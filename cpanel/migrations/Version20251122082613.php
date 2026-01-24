<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251122082613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rent_contract DROP FOREIGN KEY fk_contract_landlord');
        $this->addSql('ALTER TABLE rent_contract DROP FOREIGN KEY fk_contract_property');
        $this->addSql('ALTER TABLE rent_contract DROP FOREIGN KEY fk_contract_tenant');
        $this->addSql('ALTER TABLE rent_billing DROP FOREIGN KEY fk_rent_contract');
        $this->addSql('ALTER TABLE rent_billing DROP FOREIGN KEY fk_rent_property');
        $this->addSql('DROP TABLE transcription');
        $this->addSql('DROP TABLE rent_property');
        $this->addSql('DROP TABLE rent_landlord');
        $this->addSql('DROP TABLE rent_tenant');
        $this->addSql('DROP TABLE rent_contract');
        $this->addSql('DROP TABLE rent_billing');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transcription (id INT AUTO_INCREMENT NOT NULL, fileid INT NOT NULL, start NUMERIC(10, 3) NOT NULL, stop NUMERIC(10, 3) NOT NULL, who VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, context LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rent_property (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address_street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_door VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_fraction VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_codpostal VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_state VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_country VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, serie VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT NULL, active TINYINT(1) DEFAULT 1, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rent_landlord (id INT UNSIGNED AUTO_INCREMENT NOT NULL, nif VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address_street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_door VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_fraction VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_codpostal VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_state VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_country VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(190) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, telf VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, telm VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, serie VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT NULL, active TINYINT(1) DEFAULT 1, UNIQUE INDEX landlord_nif_unique (nif), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rent_tenant (id INT UNSIGNED AUTO_INCREMENT NOT NULL, nif VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address_street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_door VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_fraction VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_codpostal VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_state VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, address_country VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(190) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, telf VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, telm VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, serie VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT NULL, active TINYINT(1) DEFAULT 1, UNIQUE INDEX tenant_nif_unique (nif), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rent_contract (id INT UNSIGNED AUTO_INCREMENT NOT NULL, landlord_id INT UNSIGNED NOT NULL, tenant_id INT UNSIGNED NOT NULL, property_id INT UNSIGNED NOT NULL, cycle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'monthly\' COLLATE `utf8mb4_unicode_ci`, rent NUMERIC(16, 6) DEFAULT \'0.000000\' NOT NULL, rescisao INT UNSIGNED NOT NULL, cond_iban VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, cond_dias INT DEFAULT 0, duracao INT UNSIGNED NOT NULL, dataini DATETIME NOT NULL, datafim DATETIME NOT NULL, active TINYINT(1) DEFAULT 1, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT NULL, INDEX fk_contract_landlord (landlord_id), INDEX fk_contract_property (property_id), INDEX fk_contract_tenant (tenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rent_billing (id INT UNSIGNED AUTO_INCREMENT NOT NULL, contract_id INT UNSIGNED NOT NULL, property_id INT UNSIGNED NOT NULL, cycle VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, descr VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, value NUMERIC(16, 6) DEFAULT \'0.000000\' NOT NULL, dataini DATETIME NOT NULL, datafim DATETIME NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT NULL, INDEX fk_rent_contract (contract_id), INDEX fk_rent_property (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE rent_contract ADD CONSTRAINT fk_contract_landlord FOREIGN KEY (landlord_id) REFERENCES rent_landlord (id)');
        $this->addSql('ALTER TABLE rent_contract ADD CONSTRAINT fk_contract_property FOREIGN KEY (property_id) REFERENCES rent_property (id)');
        $this->addSql('ALTER TABLE rent_contract ADD CONSTRAINT fk_contract_tenant FOREIGN KEY (tenant_id) REFERENCES rent_tenant (id)');
        $this->addSql('ALTER TABLE rent_billing ADD CONSTRAINT fk_rent_contract FOREIGN KEY (contract_id) REFERENCES rent_contract (id)');
        $this->addSql('ALTER TABLE rent_billing ADD CONSTRAINT fk_rent_property FOREIGN KEY (property_id) REFERENCES rent_property (id)');
        $this->addSql('DROP TABLE user');
    }
}
