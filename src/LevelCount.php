<?php

namespace IqTool\Ci3LogViewer;

class LevelCount
{
    public function __construct(
        public string $level,
        public int $count = 0,
        public bool $selected = true
    ) {
    }
}
