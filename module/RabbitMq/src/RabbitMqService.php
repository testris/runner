<?php

namespace RabbitMq;

use PhpAmqpLib\Connection\AbstractConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqService
{
    /**
     * @var AbstractConnection
     */
    private $connection;

    /**
     * RabbitMqService constructor.
     * @param AbstractConnection $connection
     */
    public function __construct(
        AbstractConnection $connection
    ) {
        $this->connection = $connection;
    }

    /**
     * @param RabbitMqMessageContext $context
     */
    public function pushMessage(RabbitMqMessageContext $context)
    {
        $channel = $this->connection->channel();
        $channel->queue_declare($context->getQueue(), false, true, false, false);

        $message = new AMQPMessage($context->getMessage(), [
            'content_type' => 'text/plain', 'delivery_mode' => 2
        ]);

        $channel->basic_publish($message, '', $context->getQueue());

        $channel->close();
    }

    /**
     * Publish/Subscribe - deliver a message to multiple consumers
     *
     * @param string $queueName
     * @param array $data
     */
    public function pubSubMessage($queueName, $data)
    {
        $channel = $this->connection->channel();

        $channel->exchange_declare($queueName, 'fanout', false, false, false);

        $data = json_encode($data);

        $msg = new AMQPMessage($data);

        $channel->basic_publish($msg, $queueName);

        $channel->close();
    }
}