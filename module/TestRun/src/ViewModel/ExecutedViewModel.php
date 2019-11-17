<?php

namespace TestRun\ViewModel;

use Zend\View\Model\ViewModel;

class ExecutedViewModel extends ViewModel
{
    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        if ($name == 'value') {
            $started = parent::getVariable('started', $default);
            $ended = parent::getVariable('ended', $default);

            if (!$started || !$ended) {
                return 'Not ended';
            }

            $timeStarted = new \DateTime($started);
            $timeEnded = new \DateTime($ended);

            $interval = $timeStarted->diff($timeEnded);

            return implode(' ', [
                ($interval->format('%h')) ? $interval->format('%r%hh') : false,
                ($interval->format('%i')) ? $interval->format('%r%im') : false,
                ($interval->format('%s')) ? $interval->format('%r%ss') : false,
            ]);
        }

        return parent::getVariable($name, $default);
    }
}