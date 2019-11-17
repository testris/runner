<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181031092244 extends AbstractVersion
{
    public $description = 'add result history';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_results_history` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `run_id` INT NOT NULL DEFAULT 0,
            `result_id` INT NOT NULL DEFAULT 0,
            `case_id` INT NOT NULL DEFAULT 0,
            `status` TINYINT NOT NULL,
            `executed` TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }
}
