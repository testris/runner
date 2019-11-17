<?php

namespace TestRun\ViewModel;

use TestRun\Entity\TestRunStatuses;

class RunButtonViewModel extends \Application\ViewModel\EditButtonViewModel
{
    public function getVariable($name, $default = null)
    {
        if ($name == 'disabled') {
            return !in_array(
                parent::getVariable('status'),
                [TestRunStatuses::UNTESTED, TestRunStatuses::FAILED, TestRunStatuses::BROKEN]
            );
        }

        if (in_array(parent::getVariable('status'), [TestRunStatuses::FAILED, TestRunStatuses::BROKEN])) {
            if ($name == 'text') {
                return 'Re-run';
            }

            if ($name == 'routeName') {
                return 'TestRun-rerun';
            }

            if ($name == 'icon') {
                return 'fa-refresh';
            }
        }

        return parent::getVariable($name, $default);
    }
}