<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180707102126 extends AbstractVersion
{
    public $description = 'create results_steps table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_results_steps` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `run_id` INT NOT NULL,
            `case_id` INT NOT NULL,
            `result_id` INT NOT NULL,
            `action_text` VARCHAR(500) NOT NULL,
            `status` TINYINT NOT NULL DEFAULT 0,
            `is_meta_step` TINYINT NOT NULL DEFAULT 0,
            `elapsed` INT DEFAULT 0,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }
}
