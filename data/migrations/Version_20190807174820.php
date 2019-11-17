<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20190807174820 extends AbstractVersion
{
    public $description = 'drop excessive column case_ids from tr_runs table';

    public function up()
    {
        $this->executeQuery(
            "ALTER TABLE `tr_runs` DROP `case_ids`;"
        );
    }
}
