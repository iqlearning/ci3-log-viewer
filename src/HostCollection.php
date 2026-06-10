<?php

namespace IqTool\Ci3LogViewer;

class HostCollection
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

    public function add(Host $host): void
    {
        $this->items[] = $host;
    }

    public function first(callable $callback = null, mixed $default = null): ?Host
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
}
