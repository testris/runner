<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180712182658 extends AbstractVersion
{
    public $description = 'add artifacts field to tr_results_steps';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_results_steps
	        ADD COLUMN `artifacts` TEXT DEFAULT NULL AFTER `meta_step_id`");
    }
}
