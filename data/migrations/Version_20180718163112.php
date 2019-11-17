<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180718163112 extends AbstractVersion
{
    public $description = 'add ended field to tr_runs';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs ADD ended TIMESTAMP NULL;");
    }
}
