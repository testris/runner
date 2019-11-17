<?php

namespace TestCase\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\TestCaseStatuses;
use Sites\Entity\Site;

class SitesTestsViewModel extends SectionsViewModel
{
    /**
     * @var RepositoryInterface
     */
    private $casesRepository;

    /**
     * @var array
     */
    private static $testsBySites;

    /**
     * @var integer
     */
    private static $newTests;

    /**
     * SitesTestsViewModel constructor.
     * @param RepositoryInterface $casesRepository
     * @param RepositoryInterface $sitesRepository
     */
    public function __construct(
        RepositoryInterface $casesRepository,
        RepositoryInterface $sitesRepository
    ) {
        $this->casesRepository = $casesRepository;
        $this->sitesRepository = $sitesRepository;
    }

    public function getAllCases()
    {
        if (self::$testsBySites) {
            return self::$testsBySites;
        }

        /** @var Site[] $sites */
        $sites = $this->sitesRepository->findMany([]);

        self::$testsBySites = [];

        foreach ($sites as $site) {
            $casesCount =  $this->casesRepository->count([
                'status_equalTo' => TestCaseStatuses::ACTIVE,
                'siteId_equalTo' => $site->getId(),
                'automatedClass_notEqualTo' => '',
                'order' => 'id ASC',
            ]);
            self::$testsBySites[$site->getDomain()] = $casesCount;
        }

        arsort(self::$testsBySites);

        return self::$testsBySites;
    }

    public function getNewCases()
    {
        if (self::$newTests) {
            return self::$newTests;
        }

        self::$newTests = $this->casesRepository->count([
            'created_greaterThan' => date("Y-m-d 00:00:01", strtotime("-7 days"))
        ]);

        return self::$newTests;
    }
}