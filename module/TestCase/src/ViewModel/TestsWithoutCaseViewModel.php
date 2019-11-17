<?php

namespace TestCase\ViewModel;

use Zend\View\Model\ViewModel;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\TestCase;

class TestsWithoutCaseViewModel extends ViewModel
{
    /**
     * @var RepositoryInterface
     */
    private $casesRepository;

    /**
     * @var TestCase[]
     *
     */
    private static $cacheCaseClasses = [];

    /**
     * @param RepositoryInterface $casesRepository
     */
    public function __construct(RepositoryInterface $casesRepository)
    {
        $this->casesRepository = $casesRepository;
    }

    public function getVariable($name, $default = null)
    {
        if ($name == 'value') {
            if (empty(self::$cacheCaseClasses)) {
                /** @var TestCase[] $cases */
                $cases = $this->casesRepository->findMany([]);

                foreach ($cases as $case) {
                    if ($case->getAutomatedClass()) {
                        self::$cacheCaseClasses[] = $case->getAutomatedClass();
                    }
                }
            }

            $existingClasses = json_decode(parent::getVariable($name, '[]'));

            $diff = array_diff($existingClasses, self::$cacheCaseClasses);
            return implode(PHP_EOL, $diff);
        }

        return parent::getVariable($name, $default);
    }
}