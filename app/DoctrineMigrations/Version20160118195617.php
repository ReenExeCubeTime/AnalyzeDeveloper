<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160118195617 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
            CREATE TABLE `s_developer_profile_to_skill`(
                `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                `developer_id` INT(11),
                `skill_id` INT(11),
                `position` TINYINT(11),
                `score` TINYINT(11)
            );
        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
