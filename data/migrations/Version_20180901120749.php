<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180901120749 extends AbstractVersion
{
    public $description = 'add run_by to testrun';

    public function up()
    {
        $this->executeQuery(
            "UPDATE `tr_users` 
            SET id = 2
            WHERE name='max.gulturyan'"
        );

        $this->executeQuery(
            "INSERT INTO `tr_users` (`id`, `email`, `password`, `name`) 
                  VALUES (1, 'test.runner@site.com', '', 'test.runner')"
        );

        $this->executeQuery("ALTER TABLE `tr_runs`
	        ADD COLUMN `run_by` INT DEFAULT 1 AFTER `created`");

        $this->executeQuery("ALTER TABLE `tr_runs`
	        CHANGE COLUMN `run_by` `run_by` INT NOT NULL");
    }
}
