<?php

namespace IqTool\Ci3LogViewer\Readers;

use IqTool\Ci3LogViewer\Exceptions\CannotOpenFileException;
use IqTool\Ci3LogViewer\Exceptions\CannotCloseFileException;

abstract class BaseLogReader implements LogReaderInterface
{
    protected $fileHandle;
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function isOpen(): bool
    {
        return is_resource($this->fileHandle);
    }

    public function open(): void
    {
        if ($this->isOpen()) {
            return;
        }

        if (! file_exists($this->path)) {
            throw new CannotOpenFileException("File does not exist: {$this->path}");
        }

        $this->fileHandle = fopen($this->path, 'r');

        if ($this->fileHandle === false) {
            throw new CannotOpenFileException("Could not open file: {$this->path}");
        }
    }

    public function close(): void
    {
        if (! $this->isOpen()) {
            return;
        }

        if (fclose($this->fileHandle) === false) {
            throw new CannotCloseFileException("Could not close file handle.");
        }
    }

    public function getLine(): ?string
    {
        $this->open();
        $line = fgets($this->fileHandle);

        return $line === false ? null : $line;
    }

    public function getPosition(): int
    {
        $this->open();
        return ftell($this->fileHandle);
    }

    public function seek(int $position): void
    {
        $this->open();
        fseek($this->fileHandle, $position);
    }

    public function __destruct()
    {
        $this->close();
    }
}
