<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160107171420 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql([
            '
                CREATE TABLE `s_user`(
                    `id` INT(11) PRIMARY KEY AUTO_INCREMENT
                );
            ',
            '
                CREATE TABLE `s_user_social_service`(
                    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                    `user_id` INT(11) NOT NULL
                );
            ',
            '
                CREATE TABLE `s_developer_profile`(
                    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                    `user_id` INT(11) NOT NULL,
                    `title` VARCHAR(255),
                    `description` TEXT,
                    `salary` INT(11)
                );
            ',
        ]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
