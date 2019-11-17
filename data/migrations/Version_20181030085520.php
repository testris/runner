<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181030085520 extends AbstractVersion
{
    public $description = 'add elapsed to run';

    public function up()
    {
        $this->executeQuery("ALTER TABLE `tr_runs`
	        ADD COLUMN `elapsed` MEDIUMINT UNSIGNED DEFAULT 0 AFTER `ended`");
    }
}
