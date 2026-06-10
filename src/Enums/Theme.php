<?php

namespace IqTool\Ci3LogViewer\Enums;

/**
 * UI theme constants.
 */
class Theme
{
    const LIGHT = 'light';
    const DARK = 'dark';
    const SYSTEM = 'system';

    /**
     * @var array All valid values
     */
    private static $values = [
        self::LIGHT,
        self::DARK,
        self::SYSTEM,
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
    public static function resolve($value, $default = self::SYSTEM)
    {
        return self::isValid($value) ? $value : $default;
    }
}
