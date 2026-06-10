<?php

namespace IqTool\Ci3LogViewer;

class LogFolderCollection
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

    public function add(LogFolder $folder): void
    {
        $this->items[] = $folder;
    }

    public function first(callable $callback = null, mixed $default = null): ?LogFolder
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

    public function sortBy(string $attribute, string $direction = 'asc'): self
    {
        usort($this->items, function (LogFolder $a, LogFolder $b) use ($attribute, $direction) {
            $valA = $a->{$attribute} ?? '';
            $valB = $b->{$attribute} ?? '';

            if ($valA === $valB) {
                return 0;
            }

            $comparison = $valA < $valB ? -1 : 1;
            return strtolower($direction) === 'desc' ? -$comparison : $comparison;
        });

        return $this;
    }
}
