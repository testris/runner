<?php

namespace TestRun\Action\UpdateAction;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestResult\Entity\TestResultStatuses;
use TestResult\Entity\TestResult;
use TestRun\Entity\TestRun;
use TestRun\Entity\TestRunStatuses;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $testRunRepository;

    /**
     * @var RepositoryInterface
     */
    private $testResultRepository;

    /**
     * Service constructor.
     * @param RepositoryInterface $testRunRepository
     * @param RepositoryInterface $testResultRepository
     */
    public function __construct(
        RepositoryInterface $testRunRepository,
        RepositoryInterface $testResultRepository
    ) {
        $this->testRunRepository = $testRunRepository;
        $this->testResultRepository = $testResultRepository;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var TestRun $testRun */
        $testRun = $this->testRunRepository->findById($criteria['id']);

        if (!$testRun->isStatus(TestRunStatuses::UNTESTED)) {
            return true;
        }

        $testRun->populate($changes);
        $this->testRunRepository->add($testRun);

        /** @var TestResult[] $resultList */
        $resultList = $this->testResultRepository->findMany([
            'runId_equalTo' => $testRun->getId()
        ]);

        foreach ($resultList as $testResult) {
            $this->testResultRepository->remove($testResult);
        }

        foreach ($changes['caseIds'] as $caseId) {
            $this->testResultRepository->add(new TestResult([
                'runId' => $testRun->getId(),
                'caseId' => $caseId,
                'status' => TestResultStatuses::UNTESTED,
            ]));
        }

        return true;
    }
}