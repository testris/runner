<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181115123830 extends AbstractVersion
{
    public $description = 'rename table tr_cases_diff to tr_tests_diff';

    public function up()
    {
        $this->executeQuery("RENAME TABLE tr_cases_diff TO tr_tests_diff;");
    }
}
