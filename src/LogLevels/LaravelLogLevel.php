<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class LaravelLogLevel implements LevelInterface
{
    const DEBUG = 'DEBUG';
    const INFO = 'INFO';
    const NOTICE = 'NOTICE';
    const WARNING = 'WARNING';
    const ERROR = 'ERROR';
    const CRITICAL = 'CRITICAL';
    const ALERT = 'ALERT';
    const EMERGENCY = 'EMERGENCY';
    const PROCESSING = 'PROCESSING';

    public static function getClass(string $level): string
    {
        return match (strtoupper($level)) {
            self::ERROR, self::CRITICAL, self::ALERT, self::EMERGENCY => LevelClass::DANGER,
            self::WARNING => LevelClass::WARNING,
            self::NOTICE, self::INFO, self::PROCESSING => LevelClass::INFO,
            default => LevelClass::NONE,
        };
    }
}
