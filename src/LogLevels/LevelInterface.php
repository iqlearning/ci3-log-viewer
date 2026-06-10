<?php

namespace IqTool\Ci3LogViewer\LogLevels;

interface LevelInterface
{
    public static function getClass(string $level): string;
}
