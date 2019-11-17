<?php

namespace TestRun\Console;

use Hosts\Entity\Environment;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TestCase\Entity\TestCaseStatuses;
use TestRun\Entity\TestRun;
use Zend\Db\Adapter\Adapter as DbAdapter;

class ClearRunsAction extends Command
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
     * @var DbAdapter
     */
    private $dbAdapter;

    /**
     * @param DbAdapter $dbAdapter
     */
    public function init(
        DbAdapter $dbAdapter
    ) {
        $this->dbAdapter = $dbAdapter;
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

        $this->info('Find runs to clear..');

        $runs = $this->dbAdapter->query(
            "SELECT * FROM tr_runs WHERE id < ((SELECT MAX(id) FROM tr_runs) - 100) LIMIT 10",
            DbAdapter::QUERY_MODE_EXECUTE
        );

        $this->info('Found ' . $runs->count() . ' runs.');

        if ($runs->count() == 0) {
            $this->info('Nothing to clear.');
            return;
        }

        $runIds = [];
        foreach ($runs->toArray() as $run) {
            $runIds[] = $run['id'];
        }


        $this->info('Clear tr_results for ids [' . implode(', ', $runIds) . ']..');

        $sql = sprintf(
            "DELETE FROM tr_results WHERE run_id IN (%s)",
            implode(', ', $runIds)
        );

        $this->dbAdapter->query($sql, DbAdapter::QUERY_MODE_EXECUTE);


        $this->info('Clear tr_results_history for ids [' . implode(', ', $runIds) . ']..');

        $sql = sprintf(
            "DELETE FROM tr_results_history WHERE run_id IN (%s)",
            implode(', ', $runIds)
        );

        $this->dbAdapter->query($sql, DbAdapter::QUERY_MODE_EXECUTE);


        $this->info('Clear tr_results_steps for ids [' . implode(', ', $runIds) . ']..');

        $sql = sprintf(
            "DELETE FROM tr_results_steps WHERE run_id IN (%s)",
            implode(', ', $runIds)
        );

        $this->dbAdapter->query($sql, DbAdapter::QUERY_MODE_EXECUTE);


        $this->info('Clear tr_runs_api_log for ids [' . implode(', ', $runIds) . ']..');

        $sql = sprintf(
            "DELETE FROM tr_runs_api_log WHERE run_id IN (%s)",
            implode(', ', $runIds)
        );

        $this->dbAdapter->query($sql, DbAdapter::QUERY_MODE_EXECUTE);


        $this->info('Clear tr_runs for ids [' . implode(', ', $runIds) . ']..');

        $sql = sprintf(
            "DELETE FROM tr_runs WHERE id IN (%s)",
            implode(', ', $runIds)
        );

        $this->dbAdapter->query($sql, DbAdapter::QUERY_MODE_EXECUTE);


        $this->info('Clear public/img/artifacts/* for ids [' . implode(', ', $runIds) . ']..');
        foreach ($runIds as $runId) {
            $this->rmdir('public/img/artifacts/' . $runId);
        }

        $this->info("Done.");
    }

    private function rmdir($dir) {
        if (!is_dir($dir)) {
            return;
        }

        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object)) {
                    $this->rmdir($dir . "/" . $object);
                } else {
                    unlink($dir . "/" . $object);
                }
            }
        }
        rmdir($dir);
    }

    protected function configure()
    {
        $this
            ->setName('run:clear')
            ->setDescription("Clear old runs");
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
