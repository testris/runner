<?php

namespace Data\Migrations;

use Migrations\AbstractVersion;

class Version_20181120160413 extends AbstractVersion
{
    public $description = 'add use sections';

    public function up()
    {
        $this->executeQuery(
            "INSERT INTO `tr_sections` (`id`, `parent_id`, `name`) 
                  VALUES (34, 33, 'Essay'), (35, 33, 'Resume'), (36, 33, 'CRM'), (37, 33, 'Writer');"
        );

        $this->executeQuery(
            "INSERT INTO `tr_sections` (`parent_id`, `name`) 
                  VALUES (34, 'Order'), (35, 'Order'), (36, 'Order'), (37, 'Sing up');"
        );
    }
}
