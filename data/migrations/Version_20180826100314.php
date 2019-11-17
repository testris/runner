<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180826100314 extends AbstractVersion
{
    public $description = 'change users.password to CHAR(60)';

    public function up()
    {
        $this->executeQuery("ALTER TABLE `tr_users` MODIFY password char(60) NOT NULL;");

        $passwordHash = password_hash("111", PASSWORD_DEFAULT);
        $this->executeQuery("UPDATE `tr_users` t SET t.`password` = '$passwordHash'");
    }
}
