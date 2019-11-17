<?php

namespace TestRun\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\ViewModel\SectionsViewModel;
use TestResult\Entity\TestResult;
use TestResult\Entity\TestResultStep;
use TestRun\Entity\TestRun;

class TestResultViewModel extends SectionsViewModel
{
    /**
     * @var RepositoryInterface
     */
    private $resultsRepository;

    /**
     * @var RepositoryInterface
     */
    private $resultStepsRepository;

    /**
     * @var array
     */
    private static $cacheResults;
    private static $cacheResultSteps;

    /**
     * @param RepositoryInterface $resultsRepository
     * @param RepositoryInterface $casesStepsRepository
     */
    public function __construct(
        RepositoryInterface $resultsRepository,
        RepositoryInterface $casesStepsRepository
    ) {
        $this->resultsRepository = $resultsRepository;
        $this->resultStepsRepository = $casesStepsRepository;
    }

    public function getResults()
    {
        /** @var TestRun $testRun */
        $testRun = $this->getVariable('result');
        $additionalCriteria = $this->getVariable('criteria');
        $criteria = [
            'runId_equalTo' => $testRun->getId()
        ];
        if (isset($additionalCriteria)) {
            $criteria = array_merge($criteria, $additionalCriteria);
        }

        if (empty(self::$cacheResults)) {
            self::$cacheResults = $this->resultsRepository->findMany($criteria);
        }

        return self::$cacheResults;
    }

    public function getSteps($requestedCaseId)
    {
        if (empty(self::$cacheResultSteps)) {
            /** @var TestRun $testRun */
            $testRun = $this->getVariable('result');

            /** @var TestResultStep[] $resultSteps */
            $resultSteps = $this->resultStepsRepository->findMany([
                'runId_equalTo' => $testRun->getId()
            ]);

            $stepsByCase = [];

            /** @var TestResult[] $results */
            $results = $this->getResults();

            foreach ($results as $result) {
                $stepsByCase[$result->getCaseId()] = [];
            }

            foreach ($resultSteps as $resultStep) {
                if (!isset($stepsByCase[$resultStep->getCaseId()])) {
                    $stepsByCase[$resultStep->getCaseId()] = [];
                }

                $stepsByCase[$resultStep->getCaseId()][] = $resultStep;
            }

            $stepsTree = [];
            foreach ($stepsByCase as $caseId=>$steps) {
                $lastMetaStep = null;
                /** @var TestResultStep $step */
                foreach ($steps as $step) {
                    if ($step->isMetaStep()) {
                        if (isset($lastMetaStep)) {
                            $stepsTree[$caseId][] = $lastMetaStep;
                        }
                        $lastMetaStep = $step;
                    } else {
                        $lastMetaStep->addChild($step);
                    }
                }
                $stepsTree[$caseId][] = $lastMetaStep;
            }

            self::$cacheResultSteps = $stepsTree;
        }

        return self::$cacheResultSteps[$requestedCaseId];
    }

    public function getArtifactFullPath($type)
    {

    }
}