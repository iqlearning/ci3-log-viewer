<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class RedisLogLevel implements LevelInterface
{
    const DEBUG = 'debug';
    const VERBOSE = 'verbose';
    const NOTICE = 'notice';
    const WARNING = 'warning';

    public static function getClass(string $level): string
    {
        return match (strtolower($level)) {
            self::WARNING => LevelClass::DANGER,
            self::NOTICE => LevelClass::WARNING,
            self::VERBOSE, self::DEBUG => LevelClass::INFO,
            default => LevelClass::NONE,
        };
    }
}
