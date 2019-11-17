<?php

namespace TestRun\Console;

use Hosts\Entity\Environment;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestCase\Entity\TestCaseStatuses;
use TestRun\Entity\TestRun;
use TestRun\Action\CreateAction;
use TestRun\Action\RunAction;

class RunAllCasesOnBuildAction extends Command
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var RepositoryInterface
     */
    private $casesRepository;

    /**
     * @var CreateAction\Service
     */
    private $createAction;

    /**
     * @var RunAction\Service
     */
    private $runAction;

    /**
     * @param RepositoryInterface $casesRepository
     * @param CreateAction\Service $createAction
     * @param RunAction\Service $runAction
     */
    public function init(
        RepositoryInterface $casesRepository,
        CreateAction\Service $createAction,
        RunAction\Service $runAction
    ) {
        $this->casesRepository = $casesRepository;
        $this->createAction = $createAction;
        $this->runAction = $runAction;
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void|int null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $this->info('Fetch all cases..');

        $cases = $this->casesRepository->findMany([
            'automatedClass_notEqualTo' => '',
            'status_equalTo' => TestCaseStatuses::ACTIVE
        ]);

        $casesIds = [];
        foreach($cases as $case) {
            $casesIds[] = $case->getId();
        }

        $this->info('Create run..');

        $currentBuild = file_get_contents("http://ci.uncomp.com/build/current");

        /** @var TestRun $testRun */
        $testRun = $this->createAction->handle([], [
            'title' => 'Nightly staging build (' . $currentBuild . ') ' . date("j M, Y"),
            'environment' => Environment::TYPE_STAGING,
            'branch' => '',
            'caseIds' => $casesIds
        ]);

        $this->info('Execute run..');

        $this->runAction->handle(['id' => $testRun->getId()], []);


        $this->info("Done.");
    }

    protected function configure()
    {
        $this
            ->setName('run:all-staging')
            ->setDescription("Run all cases on staging");
    }

    /**
     * Send an info string to the user.
     *
     * @param string $string
     */
    protected function info($string)
    {
        $this->output->writeln("<info>$string</info>");
    }
}
