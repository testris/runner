<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180705145243 extends AbstractVersion
{
    public $description = 'add jenkins_build_id to run';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs ADD jenkins_build_id INT DEFAULT NULL;");
    }
}
