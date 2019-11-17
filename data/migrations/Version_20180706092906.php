<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180706092906 extends AbstractVersion
{
    public $description = 'api log for run';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_runs_api_log` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `run_id` INT(11) NOT NULL,
            `uri` VARCHAR(200) NOT NULL,
            `request` TEXT DEFAULT NULL,
            `response` TEXT DEFAULT NULL,
            `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }
}
