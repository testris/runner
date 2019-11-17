<?php

namespace TestCase\Entity;

use T4webDomain\Entity;

class TestCaseDiff extends Entity
{
    /**
     * @var int
     */
    protected $sectionId;

    /**
     * @var string
     */
    protected $branch;

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
    protected $existingClasses;

    public function updateClasses($classes)
    {
        $this->existingClasses = $classes;
        $this->updated = date("Y-m-d H:i:s");
    }
}
