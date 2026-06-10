<?php

namespace IqTool\Ci3LogViewer\Concerns\LogReader;

trait CanFilterUsingIndex
{
    protected ?array $selectedLevels = null;

    public function filterLevels(?array $levels): self
    {
        $this->selectedLevels = $levels;
        return $this;
    }

    public function getSelectedLevels(): ?array
    {
        return $this->selectedLevels;
    }
}
