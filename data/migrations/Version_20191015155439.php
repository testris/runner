<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20191015155439 extends AbstractVersion
{
    public $description = 'delete user_id column from tr_sites';

    public function up()
    {
        $this->executeQuery(
            "ALTER TABLE `tr_sites` DROP FOREIGN KEY `tr_sites_ibfk_1`;"
        );
        $this->executeQuery(
            "ALTER TABLE `tr_sites` DROP INDEX user_id;"
        );
        $this->executeQuery(
            "ALTER TABLE `tr_sites` DROP COLUMN user_id;"
        );
    }
}
