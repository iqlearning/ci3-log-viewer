<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class PostgresLevel implements LevelInterface
{
    const DEBUG = 'DEBUG';
    const INFO = 'INFO';
    const NOTICE = 'NOTICE';
    const WARNING = 'WARNING';
    const ERROR = 'ERROR';
    const LOG = 'LOG';
    const FATAL = 'FATAL';
    const PANIC = 'PANIC';

    public static function getClass(string $level): string
    {
        return match (strtoupper($level)) {
            self::FATAL, self::PANIC, self::ERROR => LevelClass::DANGER,
            self::WARNING => LevelClass::WARNING,
            self::LOG, self::NOTICE, self::INFO, self::DEBUG => LevelClass::INFO,
            default => LevelClass::NONE,
        };
    }
}
