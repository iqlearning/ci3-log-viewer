<?php

namespace IqTool\Ci3LogViewer\Utils;

use IqTool\Ci3LogViewer\Exceptions\InvalidRegularExpression;

class Utils
{
    private static string $_cachedLocalIP;

    public static function bytesForHumans(int $bytes): string
    {
        if ($bytes > ($gb = 1024 * 1024 * 1024)) {
            return number_format($bytes / $gb, 2).' GB';
        } elseif ($bytes > ($mb = 1024 * 1024)) {
            return number_format($bytes / $mb, 2).' MB';
        } elseif ($bytes > ($kb = 1024)) {
            return number_format($bytes / $kb, 2).' KB';
        }

        return $bytes.' bytes';
    }

    public static function sizeOfVar(mixed $var): int
    {
        $start_memory = memory_get_usage();
        $tmp = unserialize(serialize($var));

        return memory_get_usage() - $start_memory;
    }

    public static function sizeOfVarForHumans(mixed $var): string
    {
        return self::bytesForHumans(self::sizeOfVar($var));
    }

    public static function shortMd5(string $str): string
    {
        return substr(md5($str), 0, 8);
    }

    public static function getLocalIP(): string
    {
        if (isset(self::$_cachedLocalIP)) {
            return self::$_cachedLocalIP;
        }

        if (isset($_SERVER['SERVER_ADDR'])) {
            return self::$_cachedLocalIP = $_SERVER['SERVER_ADDR'];
        }

        return self::$_cachedLocalIP = '127.0.0.1';
    }

    public static function validateRegex(string $pattern): void
    {
        if (empty($pattern)) {
            throw new InvalidRegularExpression('Regular expression pattern cannot be empty.');
        }

        // Disable error reporting temporarily to catch invalid regex errors
        $old_error_reporting = error_reporting(0);
        $result = preg_match($pattern, '');
        error_reporting($old_error_reporting);

        if ($result === false) {
            throw new InvalidRegularExpression('Invalid regular expression: ' . $pattern);
        }
    }
}
