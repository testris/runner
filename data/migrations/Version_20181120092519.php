<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181120092519 extends AbstractVersion
{
    public $description = 'add priority to cases';

    public function up()
    {
        $this->executeQuery("ALTER TABLE `tr_use_cases`
	        ADD COLUMN `priority` TINYINT DEFAULT 1 NOT NULL AFTER `section_id`");
    }
}
