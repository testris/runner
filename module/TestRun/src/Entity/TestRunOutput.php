<?php

namespace TestRun\Entity;

use T4webDomain\Entity;

class TestRunOutput extends Entity
{
    /**
     * @var int
     */
    protected $runId;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $testsOutput;

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getTestsOutput(): string
    {
        return $this->testsOutput;
    }

    public function saveOutput($output)
    {
        $this->testsOutput .= $output;
    }
}
