<?php

namespace IqTool\Ci3LogViewer\Logs;

use DateTimeInterface;

abstract class Log
{
    public static string $name = 'Log';
    public static string $levelClass = \IqTool\Ci3LogViewer\LogLevels\LaravelLogLevel::class;
    public static string $regex = '/^(?P<datetime>[\d\-+ :]+) \[(?P<level>.+)\] (?P<message>.+)$/';
    public static string $regexDatetimeKey = 'datetime';
    public static string $regexLevelKey = 'level';
    public static string $regexMessageKey = 'message';
    public static array $columns = [];

    public int $index;
    public string $fileIdentifier;
    public string $text;
    public ?DateTimeInterface $datetime = null;
    public string $level;
    public string $message;
    public array $extra = [];

    public function __construct(int $index, string $fileIdentifier, string $text)
    {
        $this->index = $index;
        $this->fileIdentifier = $fileIdentifier;
        $this->text = $text;
        $this->parse();
    }

    abstract protected function parse(): void;

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getTimestamp(): int
    {
        return $this->datetime ? $this->datetime->getTimestamp() : 0;
    }
}
