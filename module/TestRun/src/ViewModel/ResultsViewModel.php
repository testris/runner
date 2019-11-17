<?php

namespace TestRun\ViewModel;

use TestResult\Entity\TestResultStatuses;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter as DbAdapter;

class ResultsViewModel extends ViewModel
{
    /**
     * @var DbAdapter
     */
    private $dbAdapter;

    /**
     * @var array
     */
    private static $testRuns;

    /**
     * @var array
     */
    private static $testRunsResults;

    /**
     * @param DbAdapter $dbAdapter
     */
    public function __construct(DbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return ViewModel
     */
    public function setVariable($name, $value)
    {
        if ($name == 'id') {
            self::$testRuns[] = $value;
        }

        return parent::setVariable($name, $value);
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        if (in_array($name, [TestResultStatuses::PASSED, TestResultStatuses::FAILED, TestResultStatuses::BROKEN, TestResultStatuses::UNTESTED])) {
            $results = $this->load();
            $id = (int)parent::getVariable('id');

            if (!isset($results[$id])) {
                return 0;
            }

            if (!isset($results[$id][$name])) {
                return 0;
            }

            return $results[$id][$name];
        }

        return parent::getVariable($name, $default);
    }

    private function load()
    {
        if (self::$testRunsResults) {
            return self::$testRunsResults;
        }

        $sql = sprintf(
            "SELECT run_id, status, COUNT(id) AS cases_count
            FROM tr_results
            WHERE run_id IN (%s)
            GROUP BY run_id, status",
            implode(",", self::$testRuns)
        );

        $testRunsResults = $this->dbAdapter->query($sql, DbAdapter::QUERY_MODE_EXECUTE);

        foreach($testRunsResults->toArray() as $result) {
            self::$testRunsResults[$result['run_id']][$result['status']] = $result['cases_count'];
        }

        return self::$testRunsResults;
    }
}