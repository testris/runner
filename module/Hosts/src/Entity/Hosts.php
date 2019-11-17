<?php

namespace Hosts\Entity;

use T4webDomain\Entity;

class Hosts extends Entity
{
    /**
     * @var string
     */
    protected $branch;

    /**
     * @var string
     */
    protected $site;

    /**
     * @var string
     */
    protected $creator;

    /**
     * @var string
     */
    protected $environment;

    /**
     * @var string
     */
    protected $created;

    public function __construct(array $data = [])
    {
        if (!isset($data['creator'])) {
            $data['creator'] = 1;
        }

        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getBranch(): string
    {
        return $this->branch;
    }

    /**
     * @return string
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @return string
     */
    public function getCreator(): string
    {
        return $this->creator;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }
}
