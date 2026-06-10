<?php

namespace IqTool\Ci3LogViewer\Logs;

use DateTimeImmutable;
use IqTool\Ci3LogViewer\LogLevels\LaravelLogLevel;
use IqTool\Ci3LogViewer\Utils\Utils;
use IqTool\Ci3LogViewer\Utils\Str;

class LaravelLog extends Log
{
    public static string $name = 'Laravel';
    public static string $regex = '/\[(?P<datetime>[^\]]+)\] (?P<environment>\S+)\.(?P<level>\S+): (?P<message>.*)/';
    public static array $columns = [
        ['label' => 'Severity', 'data_path' => 'level'],
        ['label' => 'Datetime', 'data_path' => 'datetime'],
        ['label' => 'Env', 'data_path' => 'extra.environment'],
        ['label' => 'Message', 'data_path' => 'message'],
    ];

    protected function parse(): void
    {
        $this->text = mb_convert_encoding(rtrim($this->text, "\t\n\r"), 'UTF-8', 'UTF-8');
        $length = strlen($this->text);

        $this->extra['log_size'] = $length;
        $this->extra['log_size_formatted'] = Utils::bytesForHumans($length);

        $parts = explode("\n", Str::finish($this->text, "\n"), 2);
        $firstLine = $parts[0] ?? '';
        $theRestOfIt = $parts[1] ?? '';

        $firstLineSplit = mb_str_split($firstLine, 1000);
        $segmentToMatch = array_shift($firstLineSplit);

        preg_match(static::$regex, $segmentToMatch, $matches);

        if (! empty($matches['datetime'])) {
            $this->datetime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', substr($matches['datetime'], 0, 19)) ?: new DateTimeImmutable();
        } else {
            $this->datetime = new DateTimeImmutable();
        }

        $this->extra['environment'] = $matches['environment'] ?? null;
        $this->level = strtoupper($matches['level'] ?? 'INFO');
        $this->message = trim($matches['message'] ?? '');
    }
}
