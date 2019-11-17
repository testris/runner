<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20191008135755 extends AbstractVersion
{
    public $description = 'Add sites table';

    public function up()
    {
        $this->executeQuery(
            'CREATE TABLE IF NOT EXISTS `tr_sites` (
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `domain` VARCHAR(100) NOT NULL,
              `type` TINYINT NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;'
        );
    }
}
