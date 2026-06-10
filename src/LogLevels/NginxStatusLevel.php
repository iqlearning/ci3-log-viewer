<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class NginxStatusLevel implements LevelInterface
{
    const INFO = 'info';
    const NOTICE = 'notice';
    const WARN = 'warn';
    const ERROR = 'error';
    const CRIT = 'crit';
    const ALERT = 'alert';
    const EMERG = 'emerg';

    public static function getClass(string $level): string
    {
        return match (strtolower($level)) {
            self::EMERG, self::ALERT, self::CRIT, self::ERROR => LevelClass::DANGER,
            self::WARN => LevelClass::WARNING,
            self::NOTICE, self::INFO => LevelClass::INFO,
            default => LevelClass::NONE,
        };
    }
}
