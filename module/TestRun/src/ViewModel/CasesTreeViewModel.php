<?php

namespace TestRun\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\TestCase;
use TestCase\Entity\TestCaseStatuses;
use TestCase\ViewModel\SectionsViewModel;
use TestResult\Entity\TestResult;
use TestRun\Entity\TestRun;

class CasesTreeViewModel extends SectionsViewModel
{
    /**
     * @var mixed
     */
    private static $resultsCache;

    /**
     * CasesTreeViewModel constructor.
     * @param RepositoryInterface $sectionsRepository
     * @param RepositoryInterface $casesRepository
     * @param RepositoryInterface $resultsRepository
     * @param RepositoryInterface $sitesRepository
     */
    public function __construct(
        RepositoryInterface $sectionsRepository,
        RepositoryInterface $casesRepository,
        RepositoryInterface $resultsRepository,
        RepositoryInterface $sitesRepository
    ) {
        $this->sectionsRepository = $sectionsRepository;
        $this->casesRepository = $casesRepository;
        $this->resultsRepository = $resultsRepository;
        $this->sitesRepository = $sitesRepository;
    }

    /**
     * @return TestCase[]
     */
    protected function getAllCases()
    {
        return $this->casesRepository->findMany([
            'status_equalTo' => TestCaseStatuses::ACTIVE,
            'order' => 'id ASC'
        ]);
    }

    private function getRunResults()
    {
        /** @var TestRun $testRun */
        $testRun = $this->getVariable('result');

        if (!empty(self::$resultsCache)) {
            return self::$resultsCache;
        }

        $criteria = [
            'runId_equalTo' => $testRun->getId(),
        ];
        $additionalCriteria = $this->getVariable('criteria');
        if (isset($additionalCriteria)) {
            $criteria = array_merge($criteria, $additionalCriteria);
        }

        self::$resultsCache = $this->resultsRepository->findMany($criteria);

        return self::$resultsCache;
    }

    public function getCaseResult($caseId)
    {
        $return = null;
        /** @var TestResult $result */
        foreach ($this->getRunResults() as $result) {
            if($result->getCaseId() == $caseId) {
                $return = $result;
            }
        }

        return $return;
    }

    public function getCaseIds()
    {
        $results = $this->getRunResults();
        return $results->getCaseIds();
    }
}
