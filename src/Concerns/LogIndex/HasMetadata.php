<?php

namespace IqTool\Ci3LogViewer\Concerns\LogIndex;

trait HasMetadata
{
    protected array $metadata = [];

    protected function loadMetadata(): void
    {
        // Metadata persistence logic will be implemented later/adapted
    }

    public function getMetadata(string $key, mixed $default = null): mixed
    {
        return $this->metadata[$key] ?? $default;
    }

    public function setMetadata(string $key, mixed $value): void
    {
        $this->metadata[$key] = $value;
    }
}
