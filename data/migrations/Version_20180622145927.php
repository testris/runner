<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180622145927 extends AbstractVersion
{
    public $description = 'create table';

    public function up()
    {
        $this->executeQuery("
            CREATE TABLE IF NOT EXISTS tr_hosts
            (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                branch VARCHAR(100) NOT NULL,
                site TEXT NOT NULL,
                creator INT NOT NULL,
                environment INT NOT NULL,
                created TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
            );
        ");

        $this->executeQuery("ALTER TABLE tr_runs MODIFY environment INT NOT NULL;");
    }
}
