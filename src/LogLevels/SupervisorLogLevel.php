<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class SupervisorLogLevel implements LevelInterface
{
    const CRIT = 'crit';
    const EROR = 'eror';
    const WARN = 'warn';
    const INFO = 'info';
    const DEBG = 'debg';

    public static function getClass(string $level): string
    {
        return match (strtolower($level)) {
            self::CRIT, self::EROR => LevelClass::DANGER,
            self::WARN => LevelClass::WARNING,
            self::INFO, self::DEBG => LevelClass::INFO,
            default => LevelClass::NONE,
        };
    }
}
