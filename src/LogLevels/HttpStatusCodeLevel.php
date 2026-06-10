<?php

namespace IqTool\Ci3LogViewer\LogLevels;

class HttpStatusCodeLevel implements LevelInterface
{
    public static function getClass(string $level): string
    {
        $statusCode = intval($level);

        if ($statusCode >= 500) {
            return LevelClass::DANGER;
        }

        if ($statusCode >= 400) {
            return LevelClass::WARNING;
        }

        if ($statusCode >= 300) {
            return LevelClass::INFO;
        }

        if ($statusCode >= 200) {
            return LevelClass::SUCCESS;
        }

        return LevelClass::NONE;
    }
}
