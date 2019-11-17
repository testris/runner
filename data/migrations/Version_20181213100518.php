<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181213100518 extends AbstractVersion
{
    public $description = 'tr_runs.branch can be empty';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs MODIFY branch VARCHAR(100) NULL;");
    }
}
