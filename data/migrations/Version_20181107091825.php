<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181107091825 extends AbstractVersion
{
    public $description = 'remove elapsed from run';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_runs DROP elapsed;");
    }
}
