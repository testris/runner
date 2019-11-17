<?php

namespace TestRun\Action\SaveOutputAction;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestRun\Entity\TestRunOutput;

class Service implements ServiceInterface
{

    /**
     * @var RepositoryInterface
     */
    private $testRunOutputRepository;

    /**
     * @param RepositoryInterface $testRunOutputRepository
     */
    public function __construct(
        RepositoryInterface $testRunOutputRepository
    ) {
        $this->testRunOutputRepository = $testRunOutputRepository;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var TestRunOutput $testRunOutput */
        $testRunOutput = $this->testRunOutputRepository->find([
            'runId_equalTo' => $criteria['id'],
            'ip_equalTo' => $changes['ip'],
        ]);

        if (!$testRunOutput instanceof TestRunOutput) {
            $testRunOutput = new TestRunOutput([
                'runId' => $criteria['id'],
                'ip' => $changes['ip'],
            ]);

        }

        $testRunOutput->saveOutput($changes['output']);

        $this->testRunOutputRepository->add($testRunOutput);

        return 'ok';
    }
}