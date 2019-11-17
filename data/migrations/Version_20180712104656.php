<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180712104656 extends AbstractVersion
{
    public $description = 'add meta_step_id to tr_results_steps';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_results_steps
	        ADD COLUMN `meta_step_id` INT DEFAULT NULL AFTER `is_meta_step`");
    }
}
