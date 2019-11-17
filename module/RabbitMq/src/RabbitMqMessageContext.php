<?php

namespace RabbitMq;

class RabbitMqMessageContext
{
    /**
     * @var string
     */
    private $queue;

    /**
     * @var string
     */
    private $message;

    /**
     * @param $queue
     * @param $message
     */
    public function __construct($queue, $message)
    {
        $this->queue = (string)$queue;
        $this->message = (string)$message;
    }

    /**
     * @return string
     */
    public function getQueue(): string
    {
        return $this->queue;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}