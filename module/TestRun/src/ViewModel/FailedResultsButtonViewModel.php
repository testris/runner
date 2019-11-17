<?php

namespace TestRun\ViewModel;

use TestRun\Entity\TestRunStatuses;

class FailedResultsButtonViewModel extends \Application\ViewModel\EditButtonViewModel
{
    public function getVariable($name, $default = null)
    {
        if ($name == 'disabled') {
            return !in_array(
                parent::getVariable('status'),
                [TestRunStatuses::FAILED, TestRunStatuses::BROKEN]
            );
        }

        return parent::getVariable($name, $default);
    }
}