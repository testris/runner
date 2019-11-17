<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20180821211815 extends AbstractVersion
{
    public $description = 'create users table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(100) NOT NULL,
            `password` CHAR(42) NOT NULL,
            `name` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );

        $this->executeQuery(
            "INSERT INTO `tr_users` (`email`, `password`, `name`) 
                  VALUES ('max.gulturyan@devellar.com', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'max.gulturyan')"
        );
    }
}
