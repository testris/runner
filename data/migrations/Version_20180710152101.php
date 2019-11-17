<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180710152101 extends AbstractVersion
{
    public $description = 'add cases_diff table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_cases_diff` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `branch` VARCHAR(100) NOT NULL,
            `existing_classes` TEXT NOT NULL,
            `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }
}
