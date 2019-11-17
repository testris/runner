<?php

namespace TestResult\Entity;

use T4webDomain\Entity;

class TestResultHistory extends Entity
{
    /**
     * @var int
     */
    protected $caseId;

    /**
     * @var int
     */
    protected $runId;

    /**
     * @var int
     */
    protected $resultId;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $executed;

    /**
     * @return int
     */
    public function getCaseId(): int
    {
        return $this->caseId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

}
