<?php

namespace TestRun\Action\OutputAction;

use Hosts\Entity\Environment;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestRun\Entity\TestRun;
use Jenkins\Jenkins;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $testRunRepository;

    /**
     * @var Jenkins
     */
    private $jenkins;

    /**
     * Service constructor.
     * @param RepositoryInterface $testRunRepository
     * @param Jenkins $jenkins
     */
    public function __construct(
        RepositoryInterface $testRunRepository,
        Jenkins $jenkins
    ) {
        $this->testRunRepository = $testRunRepository;
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
        $testRun = $this->testRunRepository->findById($criteria['id']);

        $this->fetchJenkinsOutput($testRun);

        return $testRun;
    }

    private function fetchJenkinsOutput(TestRun $testRun)
    {
        if (strpos($testRun->getJenkinsOutput(), 'Finished:') !== false) {
            return;
        }

        $jobName = Environment::getJobNameByType($testRun->getEnvironment());

        if ($testRun->getJenkinsBuildId()) {
            $testRun->updateJenkinsOutput(
                $testRun->getJenkinsBuildId(),
                $this->jenkins->getConsoleTextBuild($jobName, $testRun->getJenkinsBuildId())
            );
            $this->testRunRepository->add($testRun);
            return;
        }

        $builds = $this->jenkins->getJob($jobName)
            ->getBuilds();

        foreach ($builds as $build) {
            $parameters = $build->getInputParameters();

            if (isset($parameters['runId']) && $parameters['runId'] == $testRun->getId()) {
                $testRun->updateJenkinsOutput(
                    $build->getNumber(),
                    $this->jenkins->getConsoleTextBuild($jobName, $build->getNumber())
                );
                $this->testRunRepository->add($testRun);
                return;
            }
        }
    }
}