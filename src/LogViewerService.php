<?php

namespace IqTool\Ci3LogViewer;

use IqTool\Ci3LogViewer\Cache\Ci3CacheAdapter;
use IqTool\Ci3LogViewer\Utils\Str;

class LogViewerService
{
    const DEFAULT_MAX_LOG_SIZE_TO_DISPLAY = 131072; // 128 KB

    public static string $logFileClass = LogFile::class;
    protected ?LogFileCollection $_cachedFiles = null;
    protected string $_cachedTimezone;
    protected $cache;
    protected array $config = [];

    public function __construct()
    {
        $this->cache = new Ci3CacheAdapter();
        $ci =& get_instance();
        $ci->config->load('log_viewer', TRUE, TRUE);
        $this->config = $ci->config->item('log_viewer') ?: [];
    }

    public function getCache(): Ci3CacheAdapter
    {
        return $this->cache;
    }

    public function timezone(): string
    {
        if (! isset($this->_cachedTimezone)) {
            $this->_cachedTimezone = $this->config['timezone'] 
                ?? date_default_timezone_get() 
                ?? 'UTC';
        }

        return $this->_cachedTimezone;
    }

    public function getFiles(): LogFileCollection
    {
        if ($this->_cachedFiles !== null) {
            return $this->_cachedFiles;
        }

        $collection = new LogFileCollection();
        $logPath = $this->config['base_path'] ?? APPPATH . 'logs/';

        if (is_dir($logPath)) {
            $files = glob($logPath . '*.php'); // CodeIgniter 3 default logs are php files
            if ($files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $collection->add(new LogFile($file));
                    }
                }
            }
        }

        $this->_cachedFiles = $collection;
        return $collection;
    }

    public function getFile(string $identifier): ?LogFile
    {
        return $this->getFiles()->first(fn (LogFile $file) => $file->identifier === $identifier);
    }
}
