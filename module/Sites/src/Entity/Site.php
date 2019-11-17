<?php
declare(strict_types = 1);

namespace Sites\Entity;

use T4webDomain\Entity;

class Site extends Entity
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var int
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['type'])) {
            $data['type'] = (int)$data['type'];
        }

        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}
