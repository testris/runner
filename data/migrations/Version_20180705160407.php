<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180705160407 extends AbstractVersion
{
    public $description = 'add jenkins_output to run';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs ADD jenkins_output TEXT DEFAULT NULL;");
        $this->executeQuery("ALTER TABLE tr_runs
	        CHANGE COLUMN `run_output` `tests_output` TEXT DEFAULT NULL AFTER `jenkins_output`");
    }
}
