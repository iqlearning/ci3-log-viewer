<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use IqTool\Ci3LogViewer\LogViewerService;

class Ci3LogViewer
{
    protected static ?LogViewerService $serviceInstance = null;

    public function __construct()
    {
        if (self::$serviceInstance === null) {
            self::$serviceInstance = new LogViewerService();
        }
    }

    public function getService(): LogViewerService
    {
        return self::$serviceInstance;
    }
}
