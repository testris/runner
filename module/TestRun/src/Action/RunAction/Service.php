<?php

namespace TestRun\Action\RunAction;

use Hosts\Entity\Environment;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestCase\Entity\TestCase;
use TestRun\Entity\TestRun;
use Jenkins\Jenkins;
use TestRun\Entity\TestRunStatuses;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $caseRepository;

    /**
     * @var RepositoryInterface
     */
    private $runRepository;

    /**
     * @var RepositoryInterface
     */
    private $resultRepository;

    /**
     * @var RepositoryInterface
     */
    private $siteRepository;

    /**
     * @var Jenkins
     */
    private $jenkins;

    /**
     * Service constructor.
     * @param RepositoryInterface $runRepository
     * @param RepositoryInterface $caseRepository
     * @param RepositoryInterface $resultRepository
     * @param RepositoryInterface $siteRepository
     * @param Jenkins $jenkins
     */
    public function __construct(
        RepositoryInterface $runRepository,
        RepositoryInterface $caseRepository,
        RepositoryInterface $resultRepository,
        RepositoryInterface $siteRepository,
        Jenkins $jenkins
    ) {
        $this->runRepository = $runRepository;
        $this->caseRepository = $caseRepository;
        $this->resultRepository = $resultRepository;
        $this->siteRepository = $siteRepository;
        $this->jenkins = $jenkins;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var TestRun $testRun */
        $testRun = $this->runRepository->findById($criteria['id']);
        $testRun->saveStatus(TestRunStatuses::HOSTS_BUILDING);
        $testRun->saveStarted(date('Y-m-d H:i:s'));

        $this->runRepository->add($testRun);

        /** @var TestCase[] $testCase */
        $testCases = $this->getRunCases($testRun->getId());

        $sites = $this->getRunSiteDomains($testRun->getId());

        $jobName = Environment::getJobNameByType($testRun->getEnvironment());

        $this->jenkins->enableCrumbs();
        $this->jenkins->launchJob($jobName, [
            'sitedomain' => implode(',', $sites),
            'branch' => $testRun->getBranch(),
            'subdomain' => $testRun->getBranch(),
            'runId' => $testRun->getId(),
        ]);

        return true;
    }

    private function getRunCases($runId)
    {
        $caseIds = $this->getRunCaseIds($runId);

        $cases = $this->caseRepository->findMany([
            'id_in' => $caseIds,
        ]);

        return $cases;
    }

    private function getRunCaseIds($runId)
    {
        $results = $this->getRunResults($runId);
        return $results->getCaseIds();
    }

    private function getRunResults($runId)
    {
        $results = $this->resultRepository->findMany([
            'runId_equalTo' => $runId,
        ]);

        return $results;
    }

    private function getRunSiteDomains($runId)
    {
        /** @var TestCase[] $runCases */
        $runCases = $this->getRunCases($runId);
        $runSiteIds = $runCases->getSiteIds();

        $runSites = $this->siteRepository->findMany([
            'id_in' => $runSiteIds,
        ]);
        $runSitesDomains = $runSites->getSiteDomains();

        return $runSitesDomains;
    }
}