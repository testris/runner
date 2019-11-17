<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180626172604 extends AbstractVersion
{
    public $description = 'add site id to cases';

    public function up()
    {
        $this->executeQuery("ALTER TABLE tr_cases ADD site_id INT UNSIGNED DEFAULT 0 NOT NULL;");
    }
}
