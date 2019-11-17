<?php

namespace Migrations\Action;

class RunCommandContext
{
    /**
     * @var int
     */
    private $versionNum;

    public function __construct($versionNum)
    {
        $this->versionNum = $versionNum;
    }

    /**
     * @return int
     */
    public function getVersionNum(): int
    {
        return $this->versionNum;
    }
}
