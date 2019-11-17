<?php

namespace TestCase\Entity;

use T4webDomain\Entity;

class Section extends Entity
{
    const USE_CASES = 33;
    const ESSAY = 34;
    const RESUME = 35;
    const CRM = 36;
    const WRITER = 37;

    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }
}
