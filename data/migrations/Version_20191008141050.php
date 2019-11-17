<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20191008141050 extends AbstractVersion
{
    public $description = 'Swap resumesplanet.com <-> assignmentmasters.co.uk in tr_sites table';

    public function up()
    {
        $this->executeQuery(
            "UPDATE `tr_sites` SET id = 100 WHERE id = 16;"
        );
        $this->executeQuery(
            "UPDATE `tr_sites` SET id = 16 WHERE id = 18;"
        );
        $this->executeQuery(
            "UPDATE `tr_sites` SET id = 18 WHERE id = 100;"
        );
    }
}
