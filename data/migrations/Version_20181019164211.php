<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181019164211 extends AbstractVersion
{
    public $description = 'change tr_runs_output.tests_output to MEDIUMTEXT';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs_output
	        CHANGE COLUMN `tests_output` `tests_output` MEDIUMTEXT DEFAULT NULL");
    }
}
