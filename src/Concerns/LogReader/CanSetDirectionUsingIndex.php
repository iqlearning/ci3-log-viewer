<?php

namespace IqTool\Ci3LogViewer\Concerns\LogReader;

trait CanSetDirectionUsingIndex
{
    protected string $direction = 'desc';

    public function setDirection(string $direction): self
    {
        $this->direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';
        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }
}
