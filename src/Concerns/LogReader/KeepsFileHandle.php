<?php

namespace IqTool\Ci3LogViewer\Concerns\LogReader;

trait KeepsFileHandle
{
    protected bool $keepFileHandle = false;

    public function keepFileHandle(bool $keep = true): self
    {
        $this->keepFileHandle = $keep;
        return $this;
    }

    protected function shouldCloseFileHandle(): bool
    {
        return ! $this->keepFileHandle;
    }
}
