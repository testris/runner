<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180708145429 extends AbstractVersion
{
    public $description = 'drop step_results column in results table';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_results DROP COLUMN step_results;");
    }
}
