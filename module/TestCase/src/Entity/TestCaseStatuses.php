<?php

namespace TestCase\Entity;

class TestCaseStatuses
{
    const ACTIVE = 1;
    const DISABLED = 2;

    public static $statusTypes = [
        self::ACTIVE => 'Active',
        self::DISABLED => 'Disabled',
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

    /**
     * @param int $id
     * @return string
     */
    public static function getNameById($id)
    {
        return self::$statusTypes[$id];
    }
}