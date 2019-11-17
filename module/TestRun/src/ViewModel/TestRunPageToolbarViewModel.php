<?php

namespace TestRun\ViewModel;

use Zend\View\Model\ViewModel;
use TestRun\Entity\TestRun;

class TestRunPageToolbarViewModel extends ViewModel
{
    public function getVariable($name, $default = null)
    {
        if ($name == 'status') {
            /** @var TestRun $testRun */
            $testRun = parent::getVariable('result');
            return $testRun->getStatus();
        }

        return parent::getVariable($name, $default);
    }
}