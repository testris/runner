<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180621083059 extends AbstractVersion
{
    public $description = 'create test run table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS tr_runs
                (
                    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    title VARCHAR(100) NOT NULL,
                    environment VARCHAR(100) NOT NULL,
                    branch VARCHAR(100) NOT NULL,
                    case_ids TEXT NOT NULL,
                    host VARCHAR(100) DEFAULT NULL ,
                    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }
}
