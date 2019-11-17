<?php

namespace TestResult\Entity;

use T4webDomain\Entity;

class TestResult extends Entity
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
    protected $status;

    /**
     * @var string|null
     */
    protected $failMessage;

    /**
     * @var int
     */
    protected $elapsed;

    /**
     * @var string
     */
    protected $screenUrl;

    /**
     * @var string
     */
    protected $started;

    public function __construct(array $data = [])
    {
        if (!isset($data['elapsed'])) {
            $data['elapsed'] = 0;
        }
        parent::__construct($data);
    }

    /**
     * @return int
     */
    public function getCaseId(): int
    {
        return $this->caseId;
    }

    /**
     * @return bool
     */
    public function isPassed() : bool
    {
        return ($this->status == TestResultStatuses::PASSED);
    }

    /**
     * @param int $status
     * @param int $elapsed
     * @param string $resultMessage
     */
    public function addNewResult($status, $elapsed = 0, $resultMessage = '')
    {
        $this->status = $status;
        $this->elapsed = $elapsed;
        $this->failMessage = $resultMessage;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getFailMessage(): ?string
    {
        return $this->failMessage;
    }

    /**
     * @return int
     */
    public function getRunId(): int
    {
        return $this->runId;
    }

    /**
     * @return int
     */
    public function getElapsed(): int
    {
        return $this->elapsed;
    }
}
