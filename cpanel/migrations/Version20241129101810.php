<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129101810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Rent Bundle';
    }

    public function up(Schema $schema): void
    {
        $create_table_tenant = <<<SQL
            CREATE TABLE `rent_tenant` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `nif` varchar(100) NOT NULL,
            `name` varchar(255) NOT NULL,
            `address_street` VARCHAR(255) NULL DEFAULT NULL,
            `address_door` VARCHAR(45) NULL DEFAULT NULL,
            `address_fraction` VARCHAR(45) NULL DEFAULT NULL,
            `address_codpostal` VARCHAR(45) NULL DEFAULT NULL,
            `address_state` VARCHAR(100) NULL DEFAULT NULL,
            `address_country` VARCHAR(100) NULL DEFAULT NULL,
            `email` varchar(190) NULL DEFAULT NULL,
            `telf` varchar(45) NULL DEFAULT NULL,
            `telm` varchar(45) NULL DEFAULT NULL,
            `serie` varchar(100) NULL DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT NULL,
            `active` tinyint(1) DEFAULT '1',
            PRIMARY KEY (`id`),
            UNIQUE KEY `tenant_nif_unique` (`nif`)
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE `utf8mb4_unicode_ci`;
SQL;

        $create_table_landlord = <<<SQL
            CREATE TABLE `rent_landlord` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `nif` varchar(100) NOT NULL,
            `name` varchar(255) NOT NULL,
            `address_street` VARCHAR(255) NULL DEFAULT NULL,
            `address_door` VARCHAR(45) NULL DEFAULT NULL,
            `address_fraction` VARCHAR(45) NULL DEFAULT NULL,
            `address_codpostal` VARCHAR(45) NULL DEFAULT NULL,
            `address_state` VARCHAR(100) NULL DEFAULT NULL,
            `address_country` VARCHAR(100) NULL DEFAULT NULL,
            `email` varchar(190) NULL DEFAULT NULL,
            `telf` varchar(45) NULL DEFAULT NULL,
            `telm` varchar(45) NULL DEFAULT NULL,
            `serie` varchar(100) NULL DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT NULL,
            `active` tinyint(1) DEFAULT '1',
            PRIMARY KEY (`id`),
            UNIQUE KEY `landlord_nif_unique` (`nif`)
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE `utf8mb4_unicode_ci`;
SQL;

        $create_table_property = <<<SQL
            CREATE TABLE `rent_property` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `address_street` VARCHAR(255) NULL DEFAULT NULL,
            `address_door` VARCHAR(45) NULL DEFAULT NULL,
            `address_fraction` VARCHAR(45) NULL DEFAULT NULL,
            `address_codpostal` VARCHAR(45) NULL DEFAULT NULL,
            `address_state` VARCHAR(100) NULL DEFAULT NULL,
            `address_country` VARCHAR(100) NULL DEFAULT NULL,
            `serie` varchar(100) NULL DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT NULL,
            `active` tinyint(1) DEFAULT '1',
            PRIMARY KEY (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE `utf8mb4_unicode_ci`;
SQL;

        $create_table_contract = <<<SQL
            CREATE TABLE `rent_contract` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `landlord_id` INT UNSIGNED NOT NULL,
                `tenant_id` INT UNSIGNED NOT NULL,
                `property_id` INT UNSIGNED NOT NULL,
                `cycle` ENUM('weekly', 'biweekly', 'monthly', 'bimonthly', 'quarterly', 'semiannual', 'annual') DEFAULT 'monthly',
                `rent` DECIMAL(16, 6) NOT NULL DEFAULT '0.000000',
                `rescisao` INT UNSIGNED NOT NULL,
                `cond_iban` VARCHAR(100) DEFAULT NULL,
                `cond_dias` INT NULL DEFAULT 0,
                `duracao` INT UNSIGNED NOT NULL,
                `dataini` datetime NOT NULL,
                `datafim` datetime NOT NULL,
                `active` tinyint(1) DEFAULT '1',
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT NULL,
                check (`dataini` <= `datafim`),
                CONSTRAINT PRIMARY KEY (`id`),
                CONSTRAINT `fk_contract_landlord` FOREIGN KEY (`landlord_id`) REFERENCES `rent_landlord` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                CONSTRAINT `fk_contract_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `rent_tenant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                CONSTRAINT `fk_contract_property` FOREIGN KEY (`property_id`) REFERENCES `rent_property` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE `utf8mb4_unicode_ci`;
SQL;

        $create_table_rent = <<<SQL
            CREATE TABLE `rent_billing` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `contract_id` INT UNSIGNED NOT NULL,
                `property_id` INT UNSIGNED NOT NULL,
                `cycle` VARCHAR(100) DEFAULT NULL,
                `descr` VARCHAR(255) DEFAULT NULL,
                `value` DECIMAL(16, 6) NOT NULL DEFAULT '0.000000',
                `dataini` datetime NOT NULL,
                `datafim` datetime NOT NULL,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT NULL,
                check (`dataini` <= `datafim`),
                CONSTRAINT PRIMARY KEY (`id`),
                CONSTRAINT `fk_rent_contract` FOREIGN KEY (`contract_id`) REFERENCES `rent_contract` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                CONSTRAINT `fk_rent_property` FOREIGN KEY (`property_id`) REFERENCES `rent_property` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE `utf8mb4_unicode_ci`;
SQL;

        $this->addSql($create_table_tenant);
        $this->addSql($create_table_landlord);
        $this->addSql($create_table_property);
        $this->addSql($create_table_contract);
        $this->addSql($create_table_rent);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE IF EXISTS rent_billing');
        $this->addSql('DROP TABLE IF EXISTS rent_contract');
        $this->addSql('DROP TABLE IF EXISTS rent_tenant');
        $this->addSql('DROP TABLE IF EXISTS rent_landlord');
        $this->addSql('DROP TABLE IF EXISTS rent_property');
    }
}
