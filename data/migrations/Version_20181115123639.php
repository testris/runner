<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181115123639 extends AbstractVersion
{
    public $description = 'rename table tr_cases to tr_tests';

    public function up()
    {
        $this->executeQuery("RENAME TABLE tr_cases TO tr_tests;");
    }
}
