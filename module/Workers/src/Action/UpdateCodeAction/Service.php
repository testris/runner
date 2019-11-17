<?php

namespace Workers\Action\UpdateCodeAction;

use T4webDomainInterface\ServiceInterface;
use RabbitMq\RabbitMqService;

class Service implements ServiceInterface
{
    /**
     * @var RabbitMqService
     */
    protected $mqService;

    /**
     * @param RabbitMqService $mqService
     */
    public function __construct(RabbitMqService $mqService)
    {
        $this->mqService = $mqService;
    }

    public function handle($criteria, $data)
    {
        $this->mqService->pubSubMessage('remote_executing', ['type' => 'UpdateCode', 'payload' => []]);
    }
}
