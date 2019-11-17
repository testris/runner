<?php

namespace TestResult\Entity;

use T4webDomain\Entity;

class TestResultStep extends Entity
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
     * @var string
     */
    protected $actionText;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var bool
     */
    protected $isMetaStep;

    /**
     * @var int
     */
    protected $metaStepId;

    /**
     * @var string|null
     */
    protected $artifacts;

    /**
     * @var int
     */
    protected $elapsed;

    /**
     * @var TestResultStep[]
     */
    private $children = [];

    /**
     * [
     *      "step": " I am on site \"bestessays.com\"",
     *      "result": "success",
     *      "metaStep": 1,
     *      "execTime": 4.791297912597656
     *  ],
     *
     * @param int $runId
     * @param int $caseId
     * @param int $resultId
     * @param array $step
     * @param int|null $metaStepId
     * @return TestResultStep
     */
    public static function fromResult($runId, $caseId, $resultId, array $step, $metaStepId = null)
    {
        $data = [
            'runId' => $runId,
            'caseId' => $caseId,
            'resultId' => $resultId,
            'actionText' => trim($step['step']),
            'status' => TestResultStatuses::getIdByName($step['result']),
            'isMetaStep' => $step['isMetaStep'],
            'metaStepId' => $metaStepId,
            'artifacts' => (isset($step['artifacts'])) ? json_encode($step['artifacts']) : [],
            'elapsed' => (isset($step['execTime'])) ? round($step['execTime'] * 1000) : 0,
        ];
        return new self($data);
    }

    /**
     * @return int
     */
    public function getCaseId(): int
    {
        return $this->caseId;
    }

    /**
     * @return string
     */
    public function getActionText(): string
    {
        if (strpos($this->actionText, ': ') !== false) {
            list($className, $actionText) = explode(': ', $this->actionText);
            return $actionText;
        }
        return $this->actionText;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        if (strpos($this->actionText, ': ') !== false) {
            list($className, $actionText) = explode(': ', $this->actionText);
            return $className;
        }
        return '';
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isMetaStep(): bool
    {
        return $this->isMetaStep;
    }

    /**
     * @return int
     */
    public function getElapsed(): int
    {
        return $this->elapsed;
    }

    /**
     * @param TestResultStep $step
     */
    public function addChild(TestResultStep $step)
    {
        $this->children[] = $step;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    /**
     * @return TestResultStep[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return string
     */
    public function getPngArtifact(): string
    {
        if (empty($this->artifacts)) {
            return '';
        }

        $artifacts = json_decode($this->artifacts, true);
        return isset($artifacts['png']) ? $artifacts['png'] : '';
    }

    /**
     * @return string
     */
    public function getHtmlArtifact(): string
    {
        if (empty($this->artifacts)) {
            return '';
        }

        $artifacts = json_decode($this->artifacts, true);
        return isset($artifacts['html']) ? $artifacts['html'] : '';
    }

    /**
     * @return string|null
     */
    public function getReferenceArtifact(): ?string
    {
        if (empty($this->artifacts)) {
            return '';
        }

        $artifacts = json_decode($this->artifacts, true);
        return isset($artifacts['reference']) ? $artifacts['reference'] : '';
    }

    /**
     * @return string|null
     */
    public function getReferenceSource(): ?string
    {
        $reference = $this->getReferenceArtifact();
        if (empty($reference) || strpos($reference,'-reference') === false) {
            return '';
        }
        $source = str_replace('-reference', '', $reference);

        return $source;
    }

    /**
     * @return string|null
     */
    public function getCurrentArtifact(): ?string
    {
        if (empty($this->artifacts)) {
            return '';
        }

        $artifacts = json_decode($this->artifacts, true);
        return isset($artifacts['current']) ? $artifacts['current'] : '';
    }

    /**
     * @return string|null
     */
    public function getDiffArtifact(): ?string
    {
        if (empty($this->artifacts)) {
            return '';
        }

        $artifacts = json_decode($this->artifacts, true);
        return isset($artifacts['diff']) ? $artifacts['diff'] : '';
    }
}
