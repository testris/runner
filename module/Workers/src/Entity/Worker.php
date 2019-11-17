<?php

namespace Workers\Entity;

use T4webDomain\Entity;

class Worker extends Entity
{
    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $healthCheckDate;

    /**
     * @var string
     */
    protected $lastCommand;

    /**
     * @var string
     */
    protected $lastResponse;

    public function saveLastCommand($command, $output)
    {
        $this->healthCheckDate = date('Y-m-d H:i:s');
        $this->lastCommand = $command;
        $this->lastResponse = $output;
    }
}
