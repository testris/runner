<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20190230165700 extends AbstractVersion
{
    public $description = 'add notifications column';

    public function up()
    {
        $this->executeQuery(
            "ALTER TABLE `tr_users`
                  ADD COLUMN `notifications` TINYINT DEFAULT 0;"
        );

        $this->executeQuery(
            "ALTER TABLE `tr_users`
                  ADD COLUMN `auto_notifications` TINYINT DEFAULT 0;"
        );
    }
}
