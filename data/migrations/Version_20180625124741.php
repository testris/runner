<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180625124741 extends AbstractVersion
{
    public $description = 'update tr_runs,tr_cases - add column jenkins_updated, automated_class';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs ADD jenkins_updated TIMESTAMP DEFAULT NULL  NULL;");
        $this->executeQuery("ALTER TABLE tr_cases ADD automated_class VARCHAR(120) DEFAULT NULL NULL;");
    }
}
