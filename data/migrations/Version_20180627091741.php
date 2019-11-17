<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180627091741 extends AbstractVersion
{
    public $description = 'add output field to run';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs ADD run_output TEXT DEFAULT NULL;");
    }
}
