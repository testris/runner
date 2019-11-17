<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181115141135 extends AbstractVersion
{
    public $description = 'create table tr_use_cases';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_use_cases` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `section_id` INT(11) NOT NULL,
              `title` VARCHAR(100) NOT NULL,
              `description` TEXT DEFAULT NULL,
              `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );

        $this->executeQuery(
            "INSERT INTO `tr_sections` (`id`, `parent_id`, `name`) 
                  VALUES (33, 0, 'Use Cases')"
        );
    }
}
