<?php

namespace IqTool\Ci3LogViewer\Utils;

class Benchmark
{
    protected static array $marks = [];

    public static function start(string $name): void
    {
        self::$marks[$name] = [
            'start' => microtime(true),
            'start_memory' => memory_get_usage(),
        ];
    }

    public static function stop(string $name): array
    {
        if (! isset(self::$marks[$name])) {
            return [];
        }

        $stop = microtime(true);
        $stop_memory = memory_get_usage();

        $elapsed = $stop - self::$marks[$name]['start'];
        $memory = $stop_memory - self::$marks[$name]['start_memory'];

        unset(self::$marks[$name]);

        return [
            'elapsed' => $elapsed,
            'elapsed_formatted' => number_format($elapsed * 1000, 2) . ' ms',
            'memory' => $memory,
            'memory_formatted' => Utils::bytesForHumans($memory),
        ];
    }
}
