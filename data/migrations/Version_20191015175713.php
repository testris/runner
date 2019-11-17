<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20191015175713 extends AbstractVersion
{
    public $description = 'Add into tr_sites admin.uncomp.com';

    public function up()
    {
        $this->executeQuery(
            "INSERT INTO `tr_sites` (`id`, `domain`, `type`) VALUES (3, 'admin.uncomp.com', 4);"
        );
    }
}
