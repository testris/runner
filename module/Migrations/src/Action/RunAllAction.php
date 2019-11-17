<?php

namespace Migrations\Action;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunAllAction extends Command
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
     * @var RunAllCommand
     */
    private $runAllCommandHandler;

    public function initializeCommand(RunAllCommand $runAllCommandHandler)
    {
        $this->runAllCommandHandler = $runAllCommandHandler;
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

        $this->info('Run migration..');

        $versions = $this->runAllCommandHandler->handle();

        foreach ($versions as $version) {
            $output = "  <info>✔</info> ";
            $output .= $version['version'] . ' - ' . $version['description'];
            $this->output->writeln($output);
        }

        $this->info("Done.");
    }

    protected function configure()
    {
        $this
            ->setName('migrations:run-all')
            ->setDescription("List of migration versions");
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
