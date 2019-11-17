<?php

namespace TestRun\Action\ResultAction;

use Zend\EventManager\EventManagerInterface;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestCase\Entity\TestCase;
use TestResult\Entity\TestResultStatuses;
use TestResult\Entity\TestResult;
use TestResult\Entity\TestResultStep;
use TestRun\Entity\TestRun;
use TestRun\Entity\TestRunStatuses;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $testCaseRepository;

    /**
     * @var RepositoryInterface
     */
    private $testResultRepository;

    /**
     * @var RepositoryInterface
     */
    private $testResultStepRepository;

    /**
     * @var RepositoryInterface
     */
    private $testRunRepository;

    /**
     * @var EventManagerInterface
     */
    private $eventManager;

    /**
     * Service constructor.
     * @param RepositoryInterface $testCaseRepository
     * @param RepositoryInterface $testResultRepository
     * @param RepositoryInterface $testResultStepRepository
     * @param RepositoryInterface $testRunRepository
     * @param EventManagerInterface $eventManager
     */
    public function __construct(
        RepositoryInterface $testCaseRepository,
        RepositoryInterface $testResultRepository,
        RepositoryInterface $testResultStepRepository,
        RepositoryInterface $testRunRepository,
        EventManagerInterface $eventManager
    ) {
        $this->testCaseRepository = $testCaseRepository;
        $this->testResultRepository = $testResultRepository;
        $this->testResultStepRepository = $testResultStepRepository;
        $this->testRunRepository = $testRunRepository;
        $this->eventManager = $eventManager;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var TestCase $testCase */
        $testCase = $this->testCaseRepository->find([
            'automatedClass_equalTo' => $changes['automatedClass']
        ]);

        /** @var TestResult $testResult */
        $testResult = $this->testResultRepository->find([
            'runId_equalTo' => $criteria['id'],
            'caseId_equalTo' => $testCase->getId(),
        ]);

        $testResult->addNewResult(
            TestResultStatuses::getIdByName($changes['result']),
            $changes['execTime'],
            isset($changes['resultMessage']) ? $changes['resultMessage'] : ''
        );
        $this->testResultRepository->add($testResult);

        /** @var TestRun $testRun */
        $testRun = $this->testRunRepository->findById($criteria['id']);

        if (isset($changes['steps']) && is_array($changes['steps'])) {
            $this->createSteps(
                $testRun->getId(),
                $testCase->getId(),
                $testResult->getId(),
                $changes['steps']
            );
        }

        $this->changeTestRunStatus($testRun);

        return 'ok';
    }

    public function changeTestRunStatus(TestRun $testRun)
    {
        /** @var TestResult[] $untestedResult */
        $untestedResult = $this->testResultRepository->findMany([
            'runId_equalTo' => $testRun->getId(),
            'status_equalTo' => TestRunStatuses::UNTESTED
        ]);

        // have untested tests, nothing change
        if (count($untestedResult)) {
            return;
        }

        /** @var TestResult[] $failedResult */
        $failedResult = $this->testResultRepository->findMany([
            'runId_equalTo' => $testRun->getId(),
            'status_in' => [TestRunStatuses::FAILED, TestRunStatuses::BROKEN]
        ]);

        if (count($failedResult)) {
            $testRun->saveStatus(TestRunStatuses::FAILED);
        } else {
            $testRun->saveStatus(TestRunStatuses::PASSED);
        }

        if ($testRun->isStatus([TestRunStatuses::FAILED, TestRunStatuses::BROKEN, TestRunStatuses::PASSED])) {
            $testRun->saveEnded(date('Y-m-d H:i:s'));
        }

        $this->testRunRepository->add($testRun);

        switch ($testRun->getStatus()) {
            case TestResultStatuses::FAILED :
                $this->eventManager->trigger(
                    'failed',
                    null,
                    ['testRun' => $testRun,]
                );
                break;

            case TestResultStatuses::BROKEN :
                $this->eventManager->trigger(
                    'broken',
                    null,
                    ['testRun' => $testRun,]
                );
                break;

            case TestResultStatuses::PASSED :
                $this->eventManager->trigger(
                    'passed',
                    null,
                    ['testRun' => $testRun,]
                );
                break;
        }
    }

    /**
     * [
     *      "step": " I am on site \"bestessays.com\"",
     *      "result": "success",
     *      "metaStep": 1,
     *      "execTime": 4.791297912597656
     *  ],
     *
     * @param int $runId
     * @param int $caseId
     * @param int $resultId
     * @param array $steps
     */
    private function createSteps($runId, $caseId, $resultId, array $steps)
    {
        foreach ($steps as $metaStep) {
            $metaStepEntity = TestResultStep::fromResult($runId, $caseId, $resultId, $metaStep);
            $this->testResultStepRepository->add($metaStepEntity);

            if (isset($metaStep['steps'])) {
                foreach ($metaStep['steps'] as $subStep) {
                    $step = TestResultStep::fromResult($runId, $caseId, $resultId, $subStep, $metaStepEntity->getId());
                    $this->testResultStepRepository->add($step);
                }
            }
        }
    }
}