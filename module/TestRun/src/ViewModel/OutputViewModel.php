<?php

namespace TestRun\ViewModel;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestRun\Entity\TestRunOutput;
use Zend\View\Model\ViewModel;

class OutputViewModel extends ViewModel
{
    /**
     * @var RepositoryInterface
     */
    private $testRunOutputRepository;

    /**
     * @param RepositoryInterface $testRunOutputRepository
     */
    public function __construct(
        RepositoryInterface $testRunOutputRepository
    ) {
        $this->testRunOutputRepository = $testRunOutputRepository;
    }

    public function getTestsOutput()
    {
        $id = $this->getVariable('id');

        $outputList = $this->testRunOutputRepository->findMany([
            'runId_equalTo' => $id,
        ]);

        $result = [];
        /** @var TestRunOutput $testRunOutput */
        foreach ($outputList as $testRunOutput) {
            $result[$testRunOutput->getIp()] = [
                'ip' => $testRunOutput->getIp(),
                'text' => $testRunOutput->getTestsOutput()
            ];
        }

        return $result;
    }

    public function cut($text)
    {
        $textLines = explode(PHP_EOL, $text);

        return implode(PHP_EOL, array_slice($textLines, -30, 30));
    }
}