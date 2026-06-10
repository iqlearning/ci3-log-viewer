<?php

namespace IqTool\Ci3LogViewer;

use IqTool\Ci3LogViewer\Exceptions\CannotOpenFileException;
use IqTool\Ci3LogViewer\Utils\Utils;

class LogFile
{
    use Concerns\LogFile\CanCacheData;
    use Concerns\LogFile\HasMetadata;

    public string $path;
    public string $name;
    public string $identifier;
    public string $subFolder = '';
    public string $displayPath;
    private ?string $type = null;
    private array $_logIndexCache = [];

    // Optional event listener closure instead of Event::dispatch
    public static $onDeletedCallback = null;

    public function __construct(string $path, ?string $type = null, ?string $pathAlias = null)
    {
        $this->path = $path;
        $this->name = basename($path);

        $excludeIp = false;
        $ci =& get_instance();
        if (isset($ci->config)) {
            $excludeIp = (bool) $ci->config->item('exclude_ip_from_identifiers', 'log_viewer');
        }

        if ($excludeIp) {
            $this->identifier = Utils::shortMd5($path).'-'.$this->name;
        } else {
            $this->identifier = Utils::shortMd5(Utils::getLocalIP().':'.$path).'-'.$this->name;
        }

        $this->type = $type;
        $this->displayPath = empty($pathAlias)
            ? $path
            : $pathAlias.DIRECTORY_SEPARATOR.$this->name;

        $this->subFolder = str_replace($this->name, '', $path);
        $this->subFolder = rtrim($this->subFolder, DIRECTORY_SEPARATOR);

        if (! empty($pathAlias)) {
            $this->subFolder = $pathAlias;
        }

        $this->loadMetadata();
    }

    public function delete(): bool
    {
        $this->clearCache();
        
        if (file_exists($this->path)) {
            $deleted = unlink($this->path);
            if ($deleted && is_callable(self::$onDeletedCallback)) {
                call_user_func(self::$onDeletedCallback, $this);
            }
            return $deleted;
        }
        
        return false;
    }

    public function download(): void
    {
        if (! file_exists($this->path)) {
            show_404();
            return;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $this->name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($this->path));
        
        flush();
        readfile($this->path);
        exit;
    }

    public function size(): int
    {
        return file_exists($this->path) ? filesize($this->path) : 0;
    }
}
