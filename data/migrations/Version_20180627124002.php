<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180627124002 extends AbstractVersion
{
    public $description = 'add started, status. delete jenkins_updated';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs DROP jenkins_updated;");
        $this->executeQuery("ALTER TABLE tr_runs ADD started TIMESTAMP DEFAULT NULL NULL;");
        $this->executeQuery("ALTER TABLE tr_runs ADD status TINYINT UNSIGNED DEFAULT 1 NOT NULL;");
    }
}
