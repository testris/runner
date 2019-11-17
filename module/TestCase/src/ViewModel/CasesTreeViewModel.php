<?php

namespace TestCase\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\TestCase;
use TestCase\Entity\TestCaseStatuses;

class CasesTreeViewModel extends SectionsViewModel
{
    /**
     * @var RepositoryInterface
     */
    private $casesRepository;

    /**
     * CasesTreeViewModel constructor.
     * @param RepositoryInterface $sectionsRepository
     * @param RepositoryInterface $casesRepository
     * @param RepositoryInterface $sitesRepository
     */
    public function __construct(
        RepositoryInterface $sectionsRepository,
        RepositoryInterface $casesRepository,
        RepositoryInterface $sitesRepository
    ) {
        $this->sectionsRepository = $sectionsRepository;
        $this->casesRepository = $casesRepository;
        $this->sitesRepository = $sitesRepository;
    }

    /**
     * @return \T4webDomainInterface\EntityInterface[]|TestCase[]
     */
    protected function getAllCases()
    {
        return $this->casesRepository->findMany([
            'status_equalTo' => TestCaseStatuses::ACTIVE,
            'automatedClass_notEqualTo' => '',
            'order' => 'id ASC'
        ]);
    }
}