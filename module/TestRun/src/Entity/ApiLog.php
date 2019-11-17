<?php

namespace TestRun\Entity;

use T4webDomain\Entity;

class ApiLog extends Entity
{
    /**
     * @var int
     */
    private static $curentId;

    /**
     * @var int
     */
    protected $runId;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string|null
     */
    protected $request;

    /**
     * @var string|null
     */
    protected $response;

    /**
     * @var string|null
     */
    protected $created;

    /**
     * @param array $array
     * @return $this
     */
    public function populate(array $array = [])
    {
        if (isset($array['id'])) {
            self::$curentId = $array['id'];
        }

        return parent::populate($array);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return null|string
     */
    public function getRequest(): ?string
    {
        return $this->request;
    }

    /**
     * @return null|string
     */
    public function getResponse(): ?string
    {
        return $this->response;
    }

    /**
     * @return null|string
     */
    public function getCreated(): ?string
    {
        return $this->created;
    }

    public static function getCurrentApiLogEntry()
    {
        return self::$curentId;
    }

    public function updateResponse($response)
    {
        $this->response = $response;
    }
}
