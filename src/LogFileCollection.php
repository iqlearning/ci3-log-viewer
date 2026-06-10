<?php

namespace IqTool\Ci3LogViewer;

class LogFileCollection
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function add(LogFile $file): void
    {
        $this->items[] = $file;
    }

    public function first(callable $callback = null, mixed $default = null): ?LogFile
    {
        if ($callback === null) {
            return reset($this->items) ?: $default;
        }

        foreach ($this->items as $item) {
            if ($callback($item)) {
                return $item;
            }
        }

        return $default;
    }

    public function filter(callable $callback): self
    {
        return new self(array_values(array_filter($this->items, $callback)));
    }

    public function sortUsing(string $method, string $direction): self
    {
        usort($this->items, function (LogFile $a, LogFile $b) use ($method, $direction) {
            $valA = $this->getSortValue($a, $method);
            $valB = $this->getSortValue($b, $method);

            if ($valA === $valB) {
                return 0;
            }

            $comparison = $valA < $valB ? -1 : 1;
            return strtolower($direction) === 'desc' ? -$comparison : $comparison;
        });

        return $this;
    }

    protected function getSortValue(LogFile $file, string $method): mixed
    {
        return match ($method) {
            'modified_time' => $file->getMetadata('mtime', 0),
            'size' => $file->getMetadata('size', 0),
            'name' => $file->name,
            default => $file->name,
        };
    }
}
