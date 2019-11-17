<?php

namespace TestRun\ViewModel;

use TestRun\Entity\TestRunStatuses;

class EditButtonViewModel extends \Application\ViewModel\EditButtonViewModel
{
    public function getVariable($name, $default = null)
    {
        if ($name == 'disabled') {
            return (parent::getVariable('status') != TestRunStatuses::UNTESTED);
        }

        return parent::getVariable($name, $default);
    }
}