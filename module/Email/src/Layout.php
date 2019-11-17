<?php

namespace Email;

use T4webDomain\Entity;

class Layout extends Entity
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $createdDt;

    /**
     * @var string
     */
    protected $updatedDt;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if ($this->id === null && empty($data['id'])) {
            if (empty($data['createdDt'])) {
                $data['createdDt'] = date('Y-m-d H:i:s');
            }
        } elseif ($this->id !== null) {
            $data['updatedDt'] = date('Y-m-d H:i:s');
        }

        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getCreatedDt()
    {
        return $this->createdDt;
    }

    /**
     * @return string
     */
    public function getUpdatedDt()
    {
        return $this->updatedDt;
    }

    /**
     * @param array $vars
     * @return string
     */
    public function prepareBody(array $vars)
    {
        $body = $this->body;

        foreach ($vars as $name => $value) {
            $body = str_replace('{' . $name . '}', $value, $body);
        }

        return $body;
    }
}
