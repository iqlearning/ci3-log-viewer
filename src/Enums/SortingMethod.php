<?php

namespace IqTool\Ci3LogViewer\Enums;

/**
 * Log file sorting method constants.
 */
class SortingMethod
{
    const NAME = 'name';
    const MODIFIED_TIME = 'modified_time';
    const SIZE = 'size';

    /**
     * @var array All valid values
     */
    private static $values = [
        self::NAME,
        self::MODIFIED_TIME,
        self::SIZE,
    ];

    /**
     * Check if a given value is valid.
     *
     * @param string $value
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, self::$values, true);
    }

    /**
     * Get all valid values.
     *
     * @return array
     */
    public static function values()
    {
        return self::$values;
    }

    /**
     * Resolve a value or return a default.
     *
     * @param string|null $value
     * @param string $default
     * @return string
     */
    public static function resolve($value, $default = self::NAME)
    {
        return self::isValid($value) ? $value : $default;
    }
}
