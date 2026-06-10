<?php

namespace IqTool\Ci3LogViewer;

use IqTool\Ci3LogViewer\Exceptions\InvalidChunkSizeException;

class LogIndexChunk
{
    public int $index;
    public int $size = 0;
    public array $data = [];

    public function __construct(int $index)
    {
        $this->index = $index;
    }

    public static function fromRawData(int $index, array $data): self
    {
        $chunk = new self($index);
        $chunk->data = $data;
        $chunk->size = count($data);

        return $chunk;
    }

    public function addToIndex(int $logIndex, int $filePosition, int $timestamp, string $severity): void
    {
        $this->data[$logIndex] = [$filePosition, $timestamp, $severity];
        $this->size++;
    }

    public function getPositionForIndex(int $index): ?int
    {
        return $this->data[$index][0] ?? null;
    }

    public function getTimestampForIndex(int $index): ?int
    {
        return $this->data[$index][1] ?? null;
    }

    public function getSeverityForIndex(int $index): ?string
    {
        return $this->data[$index][2] ?? null;
    }
}
