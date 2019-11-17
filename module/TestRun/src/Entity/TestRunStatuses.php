<?php

namespace TestRun\Entity;

class TestRunStatuses
{
    const UNTESTED = 1;
    const PASSED = 2;
    const FAILED = 3;
    const BROKEN = 4;
    const HOSTS_BUILDING = 5;
    const TEST_RUNNING = 6;

    public static $statusTypes = [
        self::UNTESTED => 'Untested',
        self::PASSED => 'Passed',
        self::FAILED => 'Failed',
        self::BROKEN => 'Broken',
        self::HOSTS_BUILDING => 'Hosts building',
        self::TEST_RUNNING => 'Tests running',
    ];

    /**
     * @return array
     */
    public static function getAll()
    {
        return self::$statusTypes;
    }

    /**
     * @param $typeId
     * @return mixed
     */
    public static function getById($typeId)
    {
        if (isset(self::$statusTypes[$typeId])) {
            return self::$statusTypes[$typeId];
        }

        return $typeId;
    }

    /**
     * @param $name
     * @return int|null
     */
    public static function getIdByName($name)
    {
        foreach (self::$statusTypes as $key => $status) {
            if( strtolower($name) == strtolower($status) ) {
                return $key;
            }
        }
        return null;
    }
}