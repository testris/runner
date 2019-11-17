<?php

namespace TestRun\Action\CreateAction;

use Hosts\Entity\Environment;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestResult\Entity\TestResultStatuses;
use TestResult\Entity\TestResult;
use TestRun\Entity\TestRun;
use TestRun\Action\RunAction;
use Users\Entity\User;
use Users\ViewHelper\GetMyself;

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
     * @var RunAction\Service
     */
    private $runAction;

    /**
     * @var ServiceInterface
     */
    private $hostsReadyAction;

    /**
     * @var GetMyself
     */
    private $getMyself;

    /**
     * Service constructor.
     * @param RepositoryInterface $testRunRepository
     * @param RepositoryInterface $testResultRepository
     * @param ServiceInterface $runAction
     * @param ServiceInterface $hostsReadyAction
     * @param GetMyself $getMyself
     */
    public function __construct(
        RepositoryInterface $testRunRepository,
        RepositoryInterface $testResultRepository,
        ServiceInterface $runAction,
        ServiceInterface $hostsReadyAction,
        GetMyself $getMyself
    ) {
        $this->testRunRepository = $testRunRepository;
        $this->testResultRepository = $testResultRepository;
        $this->runAction = $runAction;
        $this->hostsReadyAction = $hostsReadyAction;
        $this->getMyself = $getMyself;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        $user = $this->getMyself->get();
        if ($user) {
            $changes['runBy'] = $user->getId();
        } else {
            $changes['runBy'] = User::SYSTEM_USER_ID;
        }

        /** @var TestRun $testRun */
        $testRun = $this->testRunRepository->add(new TestRun($changes));

        foreach ($changes['caseIds'] as $caseId) {
            $this->testResultRepository->add(new TestResult([
                'runId' => $testRun->getId(),
                'caseId' => $caseId,
                'status' => TestResultStatuses::UNTESTED,
            ]));
        }

        if ($testRun->getEnvironment() == Environment::TYPE_STAGING) {
            $testRun->saveStarted(date('Y-m-d H:i:s'));
            $this->testRunRepository->add($testRun);
            $this->hostsReadyAction->handle(['id' => $testRun->getId()], []);
        } else {
            $this->runAction->handle(['id' => $testRun->getId()], []);
        }

        return $testRun;
    }
}