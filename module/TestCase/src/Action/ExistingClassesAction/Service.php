<?php

namespace TestCase\Action\ExistingClassesAction;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4webDomainInterface\ServiceInterface;
use TestCase\Entity\TestCaseDiff;

class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    private $testCaseDiffRepository;

    /**
     * Service constructor.
     * @param RepositoryInterface $testCaseDiffRepository
     */
    public function __construct(RepositoryInterface $testCaseDiffRepository)
    {
        $this->testCaseDiffRepository = $testCaseDiffRepository;
    }

    /**
     * @param mixed $criteria
     * @param mixed $changes
     * @return mixed
     */
    public function handle($criteria, $changes)
    {
        /** @var TestCaseDiff $testCaseDiff */
        $testCaseDiff = $this->testCaseDiffRepository->find([
            'branch_equalTo' => $changes['branch']
        ]);

        if (empty($testCaseDiff)) {
            $testCaseDiff = new TestCaseDiff([
                'branch' => $changes['branch'],
                'created' => date('Y-m-d H:i:s'),
                'existingClasses' => json_encode($changes['classes']),
            ]);
        } else {
            $testCaseDiff->updateClasses(json_encode($changes['classes']));
        }

        $this->testCaseDiffRepository->add($testCaseDiff);

        return 'ok';
    }
}