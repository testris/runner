<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180730142252 extends AbstractVersion
{
    public $description = 'save multiple instance test output';

    public function up()
    {
        $this->executeQuery("
CREATE TABLE tr_runs_output
(
    id int PRIMARY KEY AUTO_INCREMENT,
    run_id int NOT NULL,
    ip varchar(32),
    tests_output TEXT
);
        ");

        $this->executeQuery("alter table tr_runs drop column tests_output;");
    }
}
