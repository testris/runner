<?php

namespace TestRun\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestRun\Entity\ApiLog;
use TestRun\Entity\TestRun;
use Zend\View\Model\ViewModel;

class ApiLogViewModel extends ViewModel
{
    /**
     * @var RepositoryInterface
     */
    private $apiLogRepository;

    /**
     * Service constructor.
     * @param RepositoryInterface $apiLogRepository
     */
    public function __construct(RepositoryInterface $apiLogRepository)
    {
        $this->apiLogRepository = $apiLogRepository;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var ApiLogViewModel $apiLog */
        $apiLog = $this->apiLogRepository->findMany([
            'runId_equalTo' => $criteria['id']
        ]);

        return $apiLog;
    }

    public function getVariable($name, $default = null)
    {
        if ($name == 'log') {
            /** @var TestRun $testRun */
            $testRun = parent::getVariable('result');
            /** @var ApiLog[] $apiLog */
            $apiLog = $this->apiLogRepository->findMany([
                'runId_equalTo' => $testRun->getId()
            ]);

            return $apiLog;
        }

        return parent::getVariable($name, $default);
    }
}