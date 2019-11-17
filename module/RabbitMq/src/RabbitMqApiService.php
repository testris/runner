<?php

namespace RabbitMq;

class RabbitMqApiService
{
    private const LIST_QUEUES = '/api/queues';

    private $username;
    private $password;
    private $host;
    private $port;

    /**
     * RabbitMqApiService constructor.
     * @param array $rmqConfig
     */
    public function __construct(
        array $rmqConfig
    ) {
        $this->host = $rmqConfig['host'];
        $this->username = $rmqConfig['username'];
        $this->password = $rmqConfig['password'];
        $this->port = $rmqConfig['port'];
    }

    /**
     * @return int
     */
    public function getConsumersCount()
    {
        $queues = $this->sendApiRequest(self::LIST_QUEUES);
        foreach ($queues as $queue) {
            if ($queue->name == 'auto_tests') {
                return $queue->consumers ?? 1;
            }
        }

        return 1;
    }

    /**
     * @param $type
     * @return \Zend\Http\Response
     */
    private function sendApiRequest($type)
    {
        $url = "http://{$this->username}:{$this->password}@{$this->host}:1{$this->port}{$type}";
        $config = [
            'adapter' => 'Zend\Http\Client\Adapter\Curl',
            'curloptions' => [
                CURLOPT_TIMEOUT_MS => 60 * 10000
            ]
        ];
        $client = new \Zend\Http\Client($url, $config);
        $client->setMethod('GET');
        $client->setHeaders([
            'Content-Type' => 'application/json',
            'accept-encoding' => 'identity',
        ]);
        $response = $client->send();

        if ($response->getStatusCode() != 200) {
            throw new \RuntimeException('Response code ' . $response->getStatusCode());
        }

        $result = json_decode($response->getContent());

        return $result;
    }
}