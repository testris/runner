<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180615083059 extends AbstractVersion
{
    public $description = 'create cases table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_cases` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `section_id` INT(11) NOT NULL,
              `title` VARCHAR(100) NOT NULL,
              `preconditions` TEXT DEFAULT NULL,
              `steps` TEXT DEFAULT NULL,
              `result` TEXT DEFAULT NULL,
              `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }
}
