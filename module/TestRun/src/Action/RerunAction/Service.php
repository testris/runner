<?php

namespace TestRun\Action\RerunAction;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestRun\Entity\TestRun;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $runRepository;

    /**
     * @var RepositoryInterface
     */
    private $resultsRepository;

    /**
     * @var ServiceInterface
     */
    private $createAction;

    public function __construct(
        RepositoryInterface $runRepository,
        RepositoryInterface $resultsRepository,
        ServiceInterface $createAction
    ) {
        $this->runRepository = $runRepository;
        $this->resultsRepository = $resultsRepository;
        $this->createAction = $createAction;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var TestRun $oldRun */
        $oldRun = $this->runRepository->findById($criteria['id']);
        $failedCaseIds = $this->getRunFailedCaseIds($oldRun->getId());

        /** @var TestRun $reRun */
        $reRun = $this->createAction->handle([], [
            'title' => "Rerun failed run #{$oldRun->getId()} " . date("j M, Y"),
            'environment' => $oldRun->getEnvironment(),
            'branch' => $oldRun->getBranch(),
            'caseIds' => $failedCaseIds,
        ]);

        return $criteria + $changes;
    }

    private function getRunFailedResults($runId)
    {
        $results = $this->resultsRepository->findMany([
            'runId_equalTo' => $runId,
            'status_in' => TestRun::getFailedStatuses(),
        ]);

        return $results;
    }

    private function getRunFailedCaseIds($runId)
    {
        $results = $this->getRunFailedResults($runId);
        return $results->getCaseIds();
    }
}