<?php

namespace Hosts\Entity;

class Environment
{
    const TYPE_TEST = 1;
    const TYPE_MTEST = 2;
    const TYPE_STAGING = 3;

    const JOB_TEST = 'deploy%20on%20test%20server';
    const JOB_MTEST = 'deploy%20on%20maintenance%20test%20server';

    public static $types = [
        self::TYPE_STAGING => 'Staging',
        self::TYPE_TEST => 'Test',
        self::TYPE_MTEST => 'MTest',
    ];

    /**
     * @return array
     */
    public static function getAll()
    {
        return self::$types;
    }

    /**
     * @param $typeId
     * @return mixed
     */
    public static function getTypeById($typeId)
    {
        if (isset(self::$types[$typeId])) {
            return self::$types[$typeId];
        }

        return $typeId;
    }

    public static function getJobNameByType($type)
    {
        $jobName = 'deploy%20on%20test%20server';
        if ($type == self::TYPE_MTEST) {
            $jobName = 'deploy%20on%20maintenance%20test%20server';
        }

        return $jobName;
    }
}
