<?php

namespace TestCase\Entity;

use T4webDomain\Entity;

class TestCase extends Entity
{
    /**
     * @var int
     */
    protected $sectionId;

    /**
     * @var int
     */
    protected $caseId;

    /**
     * @var int
     */
    protected $siteId;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $preconditions;

    /**
     * @var string|null
     */
    protected $steps;

    /**
     * @var string|null
     */
    protected $result;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $updated;

    /**
     * @var string
     */
    protected $automatedClass;

    /**
     * @return int
     */
    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getPreconditions(): ?string
    {
        return $this->preconditions;
    }

    /**
     * @return null|string
     */
    public function getSteps(): ?string
    {
        return $this->steps;
    }

    /**
     * @return null|string
     */
    public function getResult(): ?string
    {
        return $this->result;
    }

    /**
     * @return null|string
     */
    public function getAutomatedClass(): ?string
    {
        return $this->automatedClass;
    }

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->siteId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCaseId(): int
    {
        return $this->caseId;
    }
}
