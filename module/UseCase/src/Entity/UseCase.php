<?php

namespace UseCase\Entity;

use T4webDomain\Entity;

class UseCase extends Entity
{
    /**
     * @var int
     */
    protected $sectionId;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string
     */
    protected $created;

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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }
}
