<?php

namespace IqTool\Ci3LogViewer\Concerns\LogIndex;

trait CanIterateIndex
{
    protected int $iteratorIndex = 0;

    public function reset(): void
    {
        $this->iteratorIndex = 0;
    }

    public function current(): ?array
    {
        $position = $this->getPositionForIndex($this->iteratorIndex);

        if ($position === null) {
            return null;
        }

        return [
            'index' => $this->iteratorIndex,
            'position' => $position,
            'timestamp' => $this->getTimestampForIndex($this->iteratorIndex),
            'severity' => $this->getSeverityForIndex($this->iteratorIndex),
        ];
    }

    public function next(): void
    {
        $this->iteratorIndex++;
    }

    public function valid(): bool
    {
        return $this->getPositionForIndex($this->iteratorIndex) !== null;
    }
}
