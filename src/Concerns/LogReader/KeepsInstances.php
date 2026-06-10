<?php

namespace IqTool\Ci3LogViewer\Concerns\LogReader;

trait KeepsInstances
{
    protected static array $instances = [];

    public static function instance(string $path): static
    {
        if (! isset(self::$instances[$path])) {
            self::$instances[$path] = new static($path);
        }

        return self::$instances[$path];
    }

    public static function clearInstances(): void
    {
        self::$instances = [];
    }
}
