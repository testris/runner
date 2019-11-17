<?php
declare(strict_types=1);

namespace Sites\Entity;

class SiteType
{
    public const ESSAY = 1;
    public const RESUME = 2;
    public const WRITER = 3;
    public const CRM = 4;

    private static $typeNames = [
        self::ESSAY => 'Essay',
        self::RESUME => 'Resume',
        self::WRITER => 'Writer',
        self::CRM => 'CRM',
    ];

    public static function getName(int $type) : string
    {
        if (array_key_exists($type, self::$typeNames)) {
            return self::$typeNames[$type];
        }

        return '';
    }

    public static function getAll()
    {
        return self::$typeNames;
    }

    public static function getIds()
    {
        return array_keys(self::$typeNames);
    }
}