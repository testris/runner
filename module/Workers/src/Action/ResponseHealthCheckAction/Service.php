<?php

namespace Workers\Action\ResponseHealthCheckAction;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use Workers\Entity\Worker;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $workerRepository;

    public function __construct(RepositoryInterface $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    public function handle($criteria, $data)
    {
        $ip = $data['ip'];

        /** @var Worker $worker */
        $worker = $this->workerRepository->find(['ip' => $ip]);

        if (!$worker) {
            $worker = new Worker([
                'ip' => $ip,
            ]);
        }

        $worker->saveLastCommand('HealthCheck', 'alive');

        $this->workerRepository->add($worker);

        return 'ok';
    }
}
