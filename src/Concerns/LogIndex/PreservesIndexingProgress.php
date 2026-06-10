<?php

namespace IqTool\Ci3LogViewer\Concerns\LogIndex;

trait PreservesIndexingProgress
{
    protected int $indexedBytes = 0;

    public function getIndexedBytes(): int
    {
        return $this->indexedBytes;
    }

    public function setIndexedBytes(int $bytes): void
    {
        $this->indexedBytes = $bytes;
    }
}
