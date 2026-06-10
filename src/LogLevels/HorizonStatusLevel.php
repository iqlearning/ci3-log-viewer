<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class HorizonStatusLevel implements LevelInterface
{
    const HORIZON_STATUS_ACTIVE = 'active';
    const HORIZON_STATUS_PAUSED = 'paused';
    const HORIZON_STATUS_INACTIVE = 'inactive';

    public static function getClass(string $level): string
    {
        return match (strtolower($level)) {
            self::HORIZON_STATUS_INACTIVE => LevelClass::DANGER,
            self::HORIZON_STATUS_PAUSED => LevelClass::WARNING,
            self::HORIZON_STATUS_ACTIVE => LevelClass::SUCCESS,
            default => LevelClass::NONE,
        };
    }
}
