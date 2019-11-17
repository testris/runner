<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180914100130 extends AbstractVersion
{
    public $description = 'add status to cases';

    public function up()
    {
        $this->executeQuery("ALTER TABLE `tr_cases`
	        ADD COLUMN `status` TINYINT DEFAULT 1 AFTER `title`");
    }
}
