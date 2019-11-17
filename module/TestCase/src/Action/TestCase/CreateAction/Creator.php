<?php

namespace TestCase\Action\TestCase\CreateAction;

use T4webDomainInterface\ServiceInterface;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use UseCase\Entity\UseCase;

class Creator implements ServiceInterface
{
    /**
     * @var ServiceInterface
     */
    protected $creator;

    /**
     * @var RepositoryInterface
     */
    protected $useCaseRepository;

    /**
     * @param ServiceInterface $creator
     * @param RepositoryInterface $useCaseRepository
     */
    public function __construct(
        ServiceInterface $creator,
        RepositoryInterface $useCaseRepository
    ) {
        $this->creator = $creator;
        $this->useCaseRepository = $useCaseRepository;
    }

    public function handle($criteria, $data)
    {
        /** @var UseCase $useCase */
        $useCase = $this->useCaseRepository->findById($data['caseId']);

        $data['sectionId'] = $useCase->getSectionId();

        return $this->creator->handle($criteria, $data);
    }
}
