<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20190214181043 extends AbstractVersion
{
    public $description = 'add workers table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_workers` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `ip` VARCHAR(15) NOT NULL,
              `health_check_date` TIMESTAMP NULL DEFAULT NULL,
              `last_command` VARCHAR(50) DEFAULT NULL,
              `last_response` TEXT DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
        );
    }
}
