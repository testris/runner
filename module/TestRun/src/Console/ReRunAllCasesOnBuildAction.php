<?php

namespace TestRun\Console;

use Hosts\Entity\Environment;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use T4webDomainInterface\Infrastructure\RepositoryInterface;
use TestRun\Action\RerunAction;

class ReRunAllCasesOnBuildAction extends Command
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
    private $testRunRepository;

    /**
     * @var RerunAction\Service
     */
    private $reRunAction;

    /**
     * @param RepositoryInterface $testRunRepository
     * @param RerunAction\Service $reRunAction
     */
    public function init(
        RepositoryInterface $testRunRepository,
        RerunAction\Service $reRunAction
    ) {
        $this->testRunRepository = $testRunRepository;
        $this->reRunAction = $reRunAction;
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

        $this->info('Find last Staging build..');

        $lastStagingRun = $this->testRunRepository->find([
            'environment_equalTo' => Environment::TYPE_STAGING,
            'branch_equalTo' => '',
            'order' => 'id DESC',
        ]);

        if ($lastStagingRun) {
            $this->info('Rerun Staging build..');
            $this->reRunAction->handle(['id' => $lastStagingRun->getId()], []);
        } else {
            $this->info('Staging build not found.');
        }

        $this->info('Done.');
    }

    protected function configure()
    {
        $this
            ->setName('re-run:all-staging')
            ->setDescription('Rerun all cases on staging');
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
