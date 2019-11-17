<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180625172314 extends AbstractVersion
{
    public $description = 'create tr_results table';

    public function up()
    {
        $this->executeQuery("
            CREATE TABLE tr_results
            (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                run_id INT UNSIGNED NOT NULL,
                case_id INT UNSIGNED NOT NULL,
                status TINYINT DEFAULT 1 NOT NULL,
                elapsed SMALLINT UNSIGNED DEFAULT 0 NOT NULL,
                step_results TEXT DEFAULT NULL ,
                screen_url VARCHAR(255) DEFAULT NULL ,
                started DATETIME DEFAULT NULL 
            );        
        ");
    }
}
