<?php

namespace TestRun\Action\HostsReadyAction;

use Hosts\Entity\Environment;
use RabbitMq\RabbitMqMessageContext;
use RabbitMq\RabbitMqService;
use RabbitMq\RabbitMqApiService;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestCase\Entity\TestCase;
use TestRun\Entity\TestRun;
use TestRun\Entity\TestRunStatuses;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $testRunRepository;

    /**
     * @var TestRun
     */
    private $testRun;

    /**
     * @var RabbitMqService
     */
    private $mqService;

    /**
     * @var RabbitMqApiService
     */
    private $rabbitMqApiService;

    /**
     * @var RepositoryInterface
     */
    private $testCaseRepository;

    /**
     * @var RepositoryInterface
     */
    private $testResultRepository;

    public function __construct(
        RepositoryInterface $testRunRepository,
        RabbitMqService $mqService,
        RabbitMqApiService $rabbitMqApiService,
        RepositoryInterface $testCaseRepository,
        RepositoryInterface $testResultRepository
    ) {
        $this->testRunRepository = $testRunRepository;
        $this->mqService = $mqService;
        $this->rabbitMqApiService = $rabbitMqApiService;
        $this->testCaseRepository = $testCaseRepository;
        $this->testResultRepository = $testResultRepository;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        $consumersCount = $this->rabbitMqApiService->getConsumersCount();
        if ($consumersCount == 0) {
            throw new \RuntimeException('Not found RabbitMQ consumers');
        }

        /** @var TestRun $testRun */
        $this->testRun = $this->testRunRepository->findById($criteria['id']);

        if ($this->testRun->isStatus(TestRunStatuses::TEST_RUNNING)) {
            return $criteria + $changes;
        }

        $this->testRun->saveStatus(TestRunStatuses::TEST_RUNNING);
        $this->testRunRepository->add($this->testRun);

        $cases = $this->getRunCases();
        $testClasses = [];
        $uiTestClasses = [];

        /** @var TestCase $case */
        foreach ($cases as $case) {
            if (strpos($case->getAutomatedClass(), 'Ui\\') !== false) {
                $uiTestClasses[] = $case->getAutomatedClass();
            } else {
                $testClasses[] = $case->getAutomatedClass();
            }
        }

        $testsQueue = $this->splitTestsForConsumers($testClasses);
        $uiTestsQueue = $this->splitTestsForConsumers($uiTestClasses);

        $this->sendTestsQueueToConsumers($testsQueue, 'acceptance');
        $this->sendTestsQueueToConsumers($uiTestsQueue, 'ui');

        return $criteria + $changes;
    }

    /**
     * @return \T4webDomainInterface\EntityInterface[]
     */
    private function getRunCases()
    {
        $runResults = $this->testResultRepository->findMany([
            'runId_equalTo' => $this->testRun->getId(),
        ]);

        $caseIds = $runResults->getCaseIds();
        $cases = $this->testCaseRepository->findMany([
            'id_in' => $caseIds,
        ]);
        return $cases;
    }

    /**
     * @param array $testClasses
     * @return array
     */
    private function splitTestsForConsumers(array $testClasses)
    {
        $testsCount = count($testClasses);
        $consumersCount = $this->rabbitMqApiService->getConsumersCount();
        $testsByConsumer = ceil($testsCount / $consumersCount);

        $queue = [];
        $partClasses = array_splice($testClasses, 0, $testsByConsumer);
        while (!empty($partClasses)) {
            $queue[] = $partClasses;
            $partClasses = array_splice($testClasses, 0, $testsByConsumer);
        }

        return $queue;
    }

    private function sendTestsQueueToConsumers($queue, $type = 'acceptance')
    {
        $data = [
            'env' => strtolower(Environment::getTypeById($this->testRun->getEnvironment())),
            'branch' => $this->testRun->getBranch(),
            'runId' => $this->testRun->getId(),
            'type' => $type,
        ];

        foreach ($queue as $tests) {
            $data['tests'] = $tests;

            $this->mqService->pushMessage(new RabbitMqMessageContext(
                'auto_tests',
                json_encode($data)
            ));
        }
    }
}
