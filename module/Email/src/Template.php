<?php

namespace Email;

use TestResult\Entity\TestResultStatuses;

class Template extends Layout
{
    public const RUN_FAILED = 1;
    public const RUN_PASSED = 2;

    public static $idsArray = [
        self::RUN_FAILED => "Fail notification",
        self::RUN_PASSED => "Passed notification",
    ];

    public static $subjectArray = [
        self::RUN_FAILED => "{name} fail",
        self::RUN_PASSED => "{name} passed",
    ];

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var int
     */
    protected $layoutId;

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return int
     */
    public function getLayoutId()
    {
        return $this->layoutId;
    }
}
