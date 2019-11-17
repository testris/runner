<?php
declare(strict_types = 1);

namespace TestRun\Entity;

use Hosts\Entity\Environment;
use T4webDomain\Entity;

class TestRun extends Entity
{
    private const STATUS_FAILED = 1;
    private const STATUS_PASSED = 2;

    private static $statuses = [
        self::STATUS_FAILED => [
            TestRunStatuses::FAILED,
            TestRunStatuses::BROKEN,
            TestRunStatuses::UNTESTED,
        ],
        self::STATUS_PASSED => [
            TestRunStatuses::PASSED,
        ],
    ];

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $environment;

    /**
     * @var string|null
     */
    protected $branch;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var int
     */
    protected $runBy;

    /**
     * @var string
     */
    protected $updated;

    /**
     * @var string
     */
    protected $started;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $jenkinsBuildId;

    /**
     * @var string|null
     */
    protected $jenkinsOutput;

    /**
     * @var string
     */
    protected $ended;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (isset($data['environment']) && $data['environment'] == Environment::TYPE_STAGING) {
            $data['branch'] = '';
        }

        if (!isset($data['host'])) {
            $data['host'] = '';
        }
        if (!isset($data['title'])) {
            $data['title'] = '';
        }
        if (isset($data['environment'])) {
            $data['environment'] = (int)$data['environment'];
        }
        if (isset($data['runBy'])) {
            $data['runBy'] = (int)$data['runBy'];
        }
        if (isset($data['jenkinsBuildId'])) {
            $data['jenkinsBuildId'] = (int)$data['jenkinsBuildId'];
        }
        if (isset($data['status'])) {
            $data['status'] = (int)$data['status'];
        } else {
            $data['status'] = TestRunStatuses::UNTESTED;
        }

        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getEnvironment(): int
    {
        return $this->environment;
    }

    /**
     * @return string
     */
    public function getBranch(): string
    {
        return (string)$this->branch;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    public function saveStatus($status) : void
    {
        $this->status = $status;
    }

    public function saveStarted($started): void
    {
        $this->started = $started;
    }

    public function saveEnded($ended): void
    {
        if (empty($this->ended)) {
            $this->ended = $ended;
        }
    }

    /**
     * @param $status
     * @return bool
     */
    public function isStatus($status): bool
    {
        if (is_array($status)) {
            return in_array($this->status, $status);
        }

        return $this->status == $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getJenkinsBuildId(): ?int
    {
        return $this->jenkinsBuildId;
    }

    /**
     * @return null|string
     */
    public function getJenkinsOutput(): ?string
    {
        return $this->jenkinsOutput;
    }

    public function updateJenkinsOutput($buildId, $output)
    {
        $this->jenkinsBuildId = $buildId;
        $this->jenkinsOutput = $output;

        if (strpos($output, 'FAILURE') !== false) {
            $this->status = TestRunStatuses::BROKEN;
        }
    }

    /**
     * @return int
     */
    public function getRunBy(): int
    {
        return $this->runBy;
    }

    public function isPassed()
    {
        if (in_array($this->getStatus(), self::$statuses[self::STATUS_PASSED])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getFailedStatuses()
    {
        return self::$statuses[self::STATUS_FAILED];
    }
}
