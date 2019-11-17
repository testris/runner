<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180712145553 extends AbstractVersion
{
    public $description = 'create /public/img/artifacts folder';

    public function up()
    {
        mkdir(dirname(dirname(__DIR__)) . "/public/img/artifacts");
    }
}
