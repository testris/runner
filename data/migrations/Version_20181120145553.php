<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181120145553 extends AbstractVersion
{
    public $description = 'link use cases with test cases';

    public function up()
    {
        $this->executeQuery("ALTER TABLE `tr_tests`
	        ADD COLUMN `case_id` INT UNSIGNED DEFAULT NULL AFTER `section_id`");
    }
}
