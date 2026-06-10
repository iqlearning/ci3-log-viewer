<?php

namespace IqTool\Ci3LogViewer\Readers;

interface LogReaderInterface
{
    public function isOpen(): bool;
    public function open(): void;
    public function close(): void;
    public function getLine(): ?string;
    public function getPosition(): int;
    public function seek(int $position): void;
}
