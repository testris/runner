<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180711163430 extends AbstractVersion
{
    public $description = 'add fail_message to tr_results';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_results
	        ADD COLUMN `fail_message` VARCHAR(500) DEFAULT NULL AFTER `status`");
    }
}
