<?php

namespace UseCase\Entity;

use T4webDomain\Entity;

class UseCasePriority extends Entity
{
    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;

    private static $priorities = [
        self::LOW => 'Low',
        self::MEDIUM => 'Medium',
        self::HIGH => 'High',
    ];

    /**
     * @return array
     */
    public static function getAll()
    {
        return self::$priorities;
    }

    /**
     * @param int $priority
     * @return string
     */
    public static function getNameById($priority)
    {
        if (isset(self::$priorities[$priority])) {
            return self::$priorities[$priority];
        }

        return;
    }
}
